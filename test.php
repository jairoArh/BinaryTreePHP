<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './logic/BinaryTree.php';

while( True ){
    $var = 67;
    break;
}

echo "La variable vale -- $var<br>";

$bn = new BinaryTree( );
$bn->addNode( "Hw050", "Kingston", "Memoria USB", 32500 );
$bn->addNode( "Hw070", "LaCie", "Disco Duro Externo 1 TB", 390000 );
$bn->addNode( "Hw020", "NVidia", "Aceleradora Grafica", 345000 );
$bn->addNode( "Hw035 ", "ATI", "Tarjeta de Video", 27000 );

$bn->addNode( "Hw090", "Seagate", "Disco Duro 3.5 540GB", 76000 );
$bn->addNode( "Hw063", "Toshibe", "Disco Duro Externo 1 TB", 167000 );
$bn->addNode( "Hw010", "Asus", "Laptop Intel Core i5", 1560000 );
$bn->addNode( "Hw068", "Genius", "Mouse Inalambrico", 34000 );

$bn->addNode( "Hw028", "Microsoft", "Teclado Ergonomico", 120000 );
$bn->addNode( "Hw023", "SanDisk", "Micro SD 32GB", 45000 );
$bn->addNode( "Hw025", "Intel", "Procesador Core i7", 420000 );
$bn->addNode( "Hw030", "MSI", "Placa Base", 315000 );


foreach( $bn->listPreorden( ) as $node ){
    echo "{$node->getIdHardware( )} {$node->getBrand()} {$node->getDescription()} {$node->getValue()}<br>";
}

echo "<p>";

foreach( $bn->listInorden( ) as $node ){
    echo "{$node->getIdHardware( )} {$node->getBrand()} {$node->getDescription()} {$node->getValue()}<br>";
}

echo "<p>";

foreach( $bn->listPosorden( ) as $node ){
    echo "{$node->getIdHardware( )} {$node->getBrand()} {$node->getDescription()} {$node->getValue()}<br>";
}
 
