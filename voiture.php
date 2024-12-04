<?php

require_once './Vehicule.php';

// ici j'ouvre ma classe
class Voiture extends Vehicule {
    // Ici je définis mes 3 attributs : nb_porte, marque et color
    public $nb_porte;


    // Ici je définis mon constructeur qui va construire mes objets
    public function __construct($nb_porte, $marque, $color) {
        // ici je construit le parent
        parent::__construct($marque, $color);
        $this->nb_porte = $nb_porte;
    }

    // Methode qui présente les attributs de la classe
    public function presenter_voiture()
    {
        echo "La voiture de marque ".$this->marque.", de couleur ". $this->color. " et qui a ".$this->nb_porte. " portes\n";
    }
}

// Ici je suis en dehors de ma classe
$voiture1 = new Voiture(3, "toyota", "rouge");
$voiture1->presenter_voiture();

