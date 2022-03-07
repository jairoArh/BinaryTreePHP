<?php

/**
 * Description of TreeNode
 *
 * @author JairoArmando
 */

require_once 'Hardware.php';

class TreeNode {
    private $info;
    private $left;
    private $right;
    
    function __construct( $info ) {
        $this->info = $info;
        $this->left = NULL;
        $this->right = NULL;
    }
    
    function getInfo( ) {
        return $this->info;
    }

    function getLeft( ) {
        return $this->left;
    }

    function getRight() {
        return $this->right;
    }

    function setInfo($info) {
        $this->info = $info;
    }

    function setLeft($left) {
        $this->left = $left;
    }

    function setRight($right) {
        $this->right = $right;
    }

}
