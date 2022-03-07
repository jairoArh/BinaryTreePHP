<?php

/**
 * Description of Hardware
 *
 * @author JairoArmando
 */
class Hardware {
    private $idHardware;
    private $brand;
    private $description;
    private $value;
    
    function __construct($idHardware, $brand, $description, $value) {
        $this->idHardware = $idHardware;
        $this->brand = $brand;
        $this->description = $description;
        $this->value = $value;
    }
    
    function getIdHardware() {
        return $this->idHardware;
    }

    function getBrand() {
        return $this->brand;
    }

    function getDescription() {
        return $this->description;
    }

    function getValue() {
        return $this->value;
    }

    function setIdHardware($idHardware) {
        $this->idHardware = $idHardware;
    }

    function setBrand($brand) {
        $this->brand = $brand;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setValue($value) {
        $this->value = $value;
    }
}
