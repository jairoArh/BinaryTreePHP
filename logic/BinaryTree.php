<?php

/**
 * Description of BinaryTree
 *
 * @author JairoArmando
 */
require_once 'TreeNode.php';

class BinaryTree {

    private $root;
    private $arrayAux;
    private $heightAux;

    function __construct() {
        $this->root = NULL;
    }

    function isEmpty() {
        return $this->root == NULL;
    }

    function addNode($idHardware, $brand, $description, $value) {
        if ($this->isEmpty()) {
            $this->root = new TreeNode(new Hardware($idHardware, $brand, $description, $value));
        } else {
            $newNode = new TreeNode(new Hardware($idHardware, $brand, $description, $value));
            $actually = $this->root;
            $last = NULL;
            while ($actually != NULL) {
                $last = $actually;
                $actually = strcmp($newNode->getInfo()->getIdHardware(), $actually->getInfo()->getIdHardware()) > 0 ? $actually->getRight() : $actually->getLeft();
            }
            if (strcmp($last->getInfo()->getIdHardware(), $newNode->getInfo()->getIdHardware()) > 0) {
                $last->setLeft($newNode);
            } else {
                $last->setRight($newNode);
            }
        }
    }

    function findObject( $id ) {
        $aux = $this->root;

        while ($aux != NULL) {
            if (strcmp($id, $aux->getInfo()->getIdHardware()) == 0) {
                return $aux->getInfo( );
            }
            $aux = strcmp($aux->getInfo()->getIdHardware(), $id) > 0 ? $aux->getLeft() : $aux->getRight();
        }

        return NULL;
    }

    private function preorden($node) {
        if ($node != NULL) {
            $this->arrayAux[] = $node->getInfo();
            $this->preorden($node->getLeft());
            $this->preorden($node->getRight());
        }
    }

    function listPreorden() {
        unset($this->arrayAux);
        $this->preorden($this->root);
        return $this->arrayAux;
    }

    private function inorden($node) {
        if ($node != NULL) {
            $this->inorden($node->getLeft());
            $this->arrayAux[] = $node->getInfo();
            $this->inorden($node->getRight());
        }
    }

    function listInorden() {
        unset($this->arrayAux);
        $this->inorden($this->root);
        return $this->arrayAux;
    }

    private function posorden($node) {
        if ($node != NULL) {
            $this->posorden($node->getLeft());
            $this->posorden($node->getRight());
            $this->arrayAux[] = $node->getInfo();
        }
    }

    function listPosorden() {
        unset($this->arrayAux);
        $this->posorden($this->root);
        return $this->arrayAux;
    }

    function findNode( $id ) {
        $aux = $this->root;
        while ($aux != NULL) {
            if (strcmp($id, $aux->getInfo()->getIdHardware()) == 0) {
                return $aux;
            }
            $aux = strcmp($aux->getInfo()->getIdHardware(), $id) > 0 ? $aux->getLeft() : $aux->getRight();
        }

        return NULL;
    }

    function gradeNode( $node ) {
        if ($node->getLeft() != NULL && $node->getRight() != NULL) {
            return 2;
        } else if ($node->getLeft() == NULL && $node->getRight() == NULL) {
            return 0;
        } else {
            return 1;
        }
    }

    function findFather( $node ) {
        $aux = $this->root;
        if ($node == $this->root) {
            return NULL;
        } else {
            while ($aux->getLeft( ) != $node && $aux->getRight( ) != $node) {
                $aux = strcmp( $aux->getInfo( )->getIdHardware( ), $node->getInfo( )->getIdHardware( ) ) > 0 ? $aux->getLeft( ) : $aux->getRight( );
            }

            return $aux;
        }
    }

    function weightTree( ) {
        return $this->weight( $this->root );
    }

    private function weight( $node ) {
        if ($node != NULL) {
            return $this->weight($node->getLeft()) + $this->weight($node->getRight()) + 1;
        }

        return 0;
    }

    function heightNode( $node ) {
        $this->heightAux = 0;
        $this->height($node, 1);
        return $this->heightAux;
    }

    function heightTree( ) {
        $this->heightAux = 0;
        $this->height( $this->root, 1 );
        return $this->heightAux;
    }

    private function height( $node, $level ) {
        if ($node != NULL) {
            $this->height($node->getLeft(), $level + 1);
            if ($level > $this->heightAux) {
                $this->heightAux = $level;
            }
            $this->height($node->getRight(), $level + 1);
        }

        return 0;
    }

    function levelNode( $node ) {
        
        if ( $node == $this->root ) {
            return 0;
        } else {
            $aux = $this->root;
            $cont = 1;
            while ($aux->getLeft() != $node && $aux->getRight() != $node) {
                $aux = strcmp($aux->getInfo()->getIdHardware(), $id) > 0 ? $aux->getLeft() : $aux->getRight();
                $cont = $cont + 1;
            }
            
            return $cont;
        }
    }
    
    function deleteNode( $node ){
        $aux = $node->getInfo( );
     
        switch( $this->gradeNode( $node ) ){
            case 0 : $this->deleteSheet( $node );
            break;
        
            case 1 : $this->deleteNodeWithSon( $node );
            break;
        
            default : $this->deleteNodeWithChild( $node );
        }
        
        return $aux;
    }
    
    function deleteSheet( $node ){
        if ( $node == $this->root ){
            $this->root = NULL;
        }
        else{
            $father = $this->findFather( $node );
            if ( $father->getLeft( ) == $node ){
                $father->setLeft( NULL );
            }
            else{
                $father->setRight( NULL );
            }
        }
    }
    
    function deleteNodeWithSon( $node ){
        $father = $this->findFather( $node );
        if ( $father  == $this->root ){
            $this->root = $father->getLeft( ) == $node ? $father->getLeft( ) : $father->getRight( );
        }
        else{
            if ( $father->getRight( ) == $node ){
                $father->setRight( $node->getRight( ) != NULL ? $node->getRight( ) : $node->getLeft( ) );
            }
            else{
                $father->setLeft( $node->getRight( ) != NULL ? $node->getRight( ) : $node->getLeft( ) );
            }
        }
    }
    
    function deleteNodeWithChild( $node ){
        $sustitute = $node->getRight( );
        $ftSust = NULL;
        while( $sustitute->getLeft( ) != NULL ){
            $ftSust = $sustitute;
            $sustitute = $sustitute->getLeft( );
        }
        if ( $ftSust != NULL ){
            $ftSust->setLeft( $sustitute->getRight( ) );
            $sustitute->setRight( $node->getRight( ) );
        }
        $sustitute->setLeft( $node->getLeft( ) );
        $father = $this->findFather( $node );
        if ( $father == NULL ){
            $this->root = $sustitute;
        }
        else{
            if ( $father->getLeft( ) == $node ){
                $father->setLeft( $sustitute );
            }
            else{
                $father->setRight( $sustitute );
            }
        }
    }

}
