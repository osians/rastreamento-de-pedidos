# Rastreamento de Pedidos - Correios
Script para Rastreamento de Pedidos dos Correios usando PHP + SOAP.

Esta é uma classe estatica criada com intuito de rastrear objetos dos correios utilizando para isso PHP e a tecnologia SOAP.
Fique a vontade para usar como desejar, em vosso sistema, seja 
ele pessoal ou comercial. 

O único intuito aqui é apresentar de forma simples o 
funcionamento da API fornecida pelos correios e dar uma solução 
para as pessoas que enfrentam problemas ao usar a API XML antiga.

## Como usar
Comece adicionando a classe ao seu script PHP e defina os parametros usados.
```php
require_once 'rastrear.class.php' ;

// parametros 
$_params = array( 'user' => 'ECT', 'pass' => 'SRO', 'tipo' => 'L', 'resultado' => 'T', 'idioma' => 101 );

// iniciando objeto
Rastrear::init( $_params );
```

Consulte o manual para entender todos os parametros.

### Realizando um rastreamento
```php
$obj = Rastrear::get( 'PE012345678BR' );
if(isset($obj->erro))
    die( $obj->erro );

// Visualizando dados basicos do objeto
echo "NUMERO: "    . $obj -> numero . "<br>" ;
echo "SIGLA: "     . $obj -> sigla . "<br>" ;
echo "NOME: "      . $obj -> nome . "<br>" ;
echo "CATEGORIA: " . $obj -> categoria . "<br>" ;
```

### Visualizando eventos do Objeto
Note que as informações sobre "Detalhes" e "Destino" nem sempre são retornados. Portanto, é importante verificar se os mesmos estão definidos antes de usálos.
```php
// CORREÇÂO: Caso objeto rastreado possua apenas 1 evento, 
// Correios retorna o evento dentro de um Object e não um Array.
if( is_object($obj->evento) ):
    $tmp = Array();
    $tmp[] = $obj->evento ;
    $obj->evento = $tmp;
endif;

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
```

### Autor
Autor: Wanderlei Santana <sans.pds@gmail.com>
site: http://sooho.com.br
Data: 2016.08.22 00:13h
Copyleft 2015
