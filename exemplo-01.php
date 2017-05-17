<?php 

require_once( 'rastrear.class.php' ) ;

/**
* Abaixo segue exemplo de uso desta classe. 
* Usando como parametros um codigo de rastreamento 
* hipotetico, e os dados de conexao que são encontrados 
* nas documentacoes do sistema.
*/

# setando os parametros de inicialização
$_params = array( 'user' => 'ECT', 'pass' => 'SRO', 'tipo' => 'L', 'resultado' => 'T', 'idioma' => 101 );

# iniciando objeto. 
# note que: mesmo que nao sejam passados parametros, 
# a classe deve funcionar corretamente com os parametros defaults.
Rastrear::init( $_params );

# rastreando um objeto hipotetico
$obj = Rastrear::get( 'JF598971235BR' );

# verificando se retornou erro 
# os erros normalmente indicam um objeto nao encontrado
if(isset($obj->erro))
    die( $obj->erro );

# Visualizando dados basicos do objeto
echo "NUMERO: "    . $obj -> numero . "<br>" ;
echo "SIGLA: "     . $obj -> sigla . "<br>" ;
echo "NOME: "      . $obj -> nome . "<br>" ;
echo "CATEGORIA: " . $obj -> categoria . "<br>" ;

// NOTA: Caso objeto rastreado possua apenas 1 evento, 
// Correios retorna o evento dentro de um Object e não um Array.
if( is_object($obj->evento) ):
    $tmp = Array();
    $tmp[] = $obj->evento ;
    $obj->evento = $tmp;
endif;

# percorrendo os eventos ocorridos com o objeto
foreach( $obj -> evento as $ev ):

    echo "TIPO: "   . $ev -> tipo   . "<br>" ;
    echo "STATUS: " . $ev -> status . "<br>" ;
    echo "DATA: "   . $ev -> data   . "<br>" ;
    echo "HORA: "   . $ev -> hora   . "<br>" ;
    echo "DESCRICAO: " . $ev -> descricao . "<br>" ;
    if( isset( $ev -> detalhe ) ) 
        echo "DETALHE: " . $ev -> detalhe . "<br>" ;
    echo "LOCAL: "  . $ev -> local  . "<br>" ;
    echo "CODIGO: " . $ev -> codigo . "<br>" ;
    echo "CIDADE: " . $ev -> cidade . "<br>" ;
    echo "UF: "     . $ev -> uf     . "<br>" ;

    if( isset( $ev -> destino ) ):
        echo " DESTINO (LOCAL): "  . $ev -> destino -> local . "<br>" ;
        echo " DESTINO (CODIGO): " . $ev -> destino -> codigo . "<br>" ;
        echo " DESTINO (CIDADE): " . $ev -> destino -> cidade . "<br>" ;
        echo " DESTINO (BAIRRO): " . $ev -> destino -> bairro . "<br>" ;
        echo " DESTINO (UF): "     . $ev -> destino -> uf . "<br>" ;
    endif;

    echo "<hr>";

endforeach;
