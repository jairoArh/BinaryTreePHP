<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './logic/BinaryTree.php';
require_once './logic/Hardware.php';

session_start( );

if ( !isset( $_SESSION[ 'bt' ] ) ){
    $_SESSION[ 'bt' ] = new BinaryTree( );
    $bt = $_SESSION[ 'bt'];
    $bt->addNode('Hw100', 'Kingston', 'Memoria USB 32GB', 45000 );
    $bt->addNode('Hw050', 'LaCie', 'Disco Duro 1TB Thunderbolt', 620000 );
    $bt->addNode('Hw075', 'Genius', 'Mouse Inalámbrico', 35000 );
    $bt->addNode('Hw150', 'NVidia', 'Aceleradora Gráfica 2GB', 380000 );
    $bt->addNode('Hw030', 'ATI', 'Tarjeta de Video', 120000 );
    $bt->addNode('Hw020', 'Microsoft', 'Teclado Ergonómico', 130000 );
    $bt->addNode('Hw040', 'Toshiba', 'Disco Duro Externo 1TB', 176000 );
    $bt->addNode('Hw045', 'Asus Zendbook', 'Laptop', 1700000 );
    $bt->addNode('Hw120', 'Intel', 'Procesador Core i7', 430000 );
    $bt->addNode('Hw110', 'Epson', 'Impresora L355', 670000 );
    $bt->addNode('Hw180', 'Litteon', 'DVD-RW', 78000 );
    $bt->addNode('Hw035', 'Lenovo', 'Pc Portatil', 1550000 );
    $bt->addNode('Hw032', 'Hewlett Packard', 'Servidor', 3500000 );
    $bt->addNode('Hw034', 'Samsung', 'Monitor 17"', 500000 );
}
$binTree = $_SESSION[ 'bt' ];
$option  = $_REQUEST[ 'option' ];

switch( $option ){
    case 'INSERT' : insert( );
    break;

    case 'LIST' : listNodes( $_REQUEST[ 'optList'] );
    break;

    case 'FIND_NODE' : findNode( );
    break;

    case 'GRADE_NODE' : gradeNode( );
    break;

    case 'FIND_FATHER' : findFather( );
    break;

    case 'WEIGHT_TREE' : weightTree( );
    break;

    case 'HEIGHT_NODE' : heightNode( );
    break;

    case 'HEIGHT_TREE' : heightTree( );
    break;

    case 'LEVEL_NODE' : levelNode( );
    break;

    case 'DELETE_NODE' : deleteNode( );
    break;
}

function deleteNode( ){
    global $binTree;
    
    $node = $binTree->findNode( $_REQUEST[ 'id' ] );
    if ( $node ){
       $aux = $binTree->deleteNode( $node );
       $hd = new stdClass( );
       $hd->id = $aux->getIdHardware( );
       $hd->brand = $aux->getBrand( );
       $hd->desc = $aux->getDescription( );
       $hd->value = $aux->getValue( );
    }
    
    echo json_encode( $hd );
}

function levelNode( ){
    global $binTree;
    
    $node = $binTree->findNode( $_REQUEST[ 'id' ] );
    if ( $node ){
       echo $binTree->levelNode( $node );
    }
    else{
        echo -1;
    }
}

function heightTree( ){
   global $binTree;
   
   if ( !$binTree->isEmpty( ) ){
       echo $binTree->heightTree( );
   }
   
   return 0;
}

function heightNode( ){
    global $binTree;
    
    $node = $binTree->findNode( $_REQUEST[ 'id' ] );
    if ( $node ){
        echo $binTree->heightNode( $node );
    }
    else{
        echo -1;
    }    
}

function weightTree( ){
    global $binTree;
    echo $binTree->weightTree( );
}

function findFather( ){
    global $binTree;
    
    $node = $binTree->findNode( $_REQUEST[ 'id' ] );
    if ( $node ){
        $father = $binTree->findFather( $node );
        $hd = new StdClass( );
        if ( $father ){
            $hd->id = $father->getInfo( )->getIdHardware( );
            $hd->brand = $father->getInfo( )->getBrand( );
            $hd->desc = $father->getInfo( )->getDescription( );
            $hd->value = $father->getInfo( )->getValue( );
        }
        else{
            $hd->id = null;
        }
    }
    echo json_encode( $hd );
}

function gradeNode( ){
    global $binTree;
    
    $node = $binTree->findNode( $_REQUEST[ 'id' ] );
    if ( $node ){
       echo $binTree->gradeNode( $node );
    }
    else{
        echo -1;
    }
}

function findNode( ){
    global $binTree;
    
    $node = $binTree->findObject( $_REQUEST[ 'id' ] );
    if ( $node ){
        $hd = new StdClass;
        $hd->id = $node->getIdHardware( );
        $hd->brand = $node->getBrand( );
        $hd->desc = $node->getDescription( );
        $hd->value = $node->getValue( );
    }
    echo json_encode( $hd );
}

function insert( ){
    global $binTree;
    
    $id = $_REQUEST[ 'idNode' ];
    $br = $_REQUEST[ 'brand' ];
    $dc = $_REQUEST[ 'description' ];
    $vl = $_REQUEST[ 'value' ];
    $op = $_REQUEST[ 'optList' ];
    if ( !$binTree->findObject( $id ) ){
        $binTree->addNode( $id, $br, $dc, $vl );
        switch( $op ){
            case 'PrO' : $arrayList = $binTree->listPreorden( );
            break;
        
            case 'InO' : $arrayList = $binTree->listInorden( );
            break;
        
            case 'PsO' : $arrayList = $binTree->listPosorden( );
            break;
        }
        foreach ( $arrayList as $node ){
            $output[ ] = ["id"=>$node->getIdHardware( ),"br"=>$node->getBrand( ),
                "ds"=>$node->getDescription( ), "vl"=>$node->getValue( ) ];
        }
    } 
    else{ 
        $output = array( );
    }
    
    echo json_encode( $output );
    
    
}

function listNodes( $option ){
   global $binTree;
    
   switch( $option ){
            case 'PrO' : $arrayList = $binTree->listPreorden( );
            break;
        
            case 'InO' : $arrayList = $binTree->listInorden( );
            break;
        
            case 'PsO' : $arrayList = $binTree->listPosorden( );
            break;
        }
        foreach ( $arrayList as $node ){
            $output[ ] = ["id"=>$node->getIdHardware( ),"br"=>$node->getBrand( ),
                "ds"=>$node->getDescription( ), "vl"=>$node->getValue( ) ];
        }
        echo json_encode( $output );
}
