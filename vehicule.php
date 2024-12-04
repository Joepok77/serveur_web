<?php

// ici j'ouvre ma classe
class Vehicule {

    public $marque;
    public $color;

    // Ici je définis mon constructeur qui va construire mes objets
    public function __construct($marque, $color) {
        $this->marque = $marque;
        $this->color = $color;
    }

}