<?php

class Personne {
   
    private $nom;
    private $age;

    // Constructeur pour initialiser $nom et $age
    public function __construct($nom, $age) {
        $this->nom = $nom;
        $this->age = $age;
    }

    // Méthode publique pour se présenter
    public function sePresenter() {
        return "Je m'appelle " . $this->nom . " et j'ai " . $this->age . " ans.";
    }
}
?>


<?php

class Employe extends Personne {
protected $poste;
    public function __construct($nom, $age, $poste) {
       
        parent::__construct($nom, $age);
        $this->poste = $poste;
    }

    public function afficherPoste() {
        return "Poste : {$this->poste}";
    }
}


?>
