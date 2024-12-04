<?php

require_once './Vehicule.php';

// ici j'ouvre ma classe
class Moto extends Vehicule {
    // Ici je définis mes 3 attributs : cylindre, marque et color
    private $cylindre; // cm cube


    // Ici je définis mon constructeur qui va construire mes objets
    public function __construct($cylindre, $marque, $color) {
        parent::__construct($marque, $color);
        $this->cylindre = $cylindre;
    }

    // Methode qui présente les attributs de la classe
    public function presenter_moto()
    {
        echo "La moto de marque ".$this->marque.", de couleur ". $this->color. " et qui a ".$this->cylindre. " cm cube\n";
    }
}

// Ici je suis en dehors de ma classe
$moto1 = new Moto(125, "honda", "bleu");
$moto1->presenter_moto();

