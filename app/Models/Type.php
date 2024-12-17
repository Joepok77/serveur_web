<?php

namespace App\Models;

use App\Utils\Database;
use PDO; // on utilise la classe PDO dont le namespace a été défini

class type extends CoreModel
{
    private $name;
   
    public function findAll()
    {
        $sql = "SELECT * FROM type";
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);
        $type = $pdoStatement->fetchAll(PDO::FETCH_CLASS, type::class);

        return $type;
    }



    /**
     * Récupère une seul categorie en fonction de son id
     * Retourne un objet (une instance de la classe Category => le model ou on est)
     */
    public function find($id)
    {
        // Ici on créer la requete SQL qui va récupérer le product en fonction de son id
        $sql = "SELECT * FROM type WHERE id = ".$id;

        // Ici $pdo est un objet de la classe Databse (Utils/Database.php)
        // $pdo va me permettre d'executer mes requetes sql
        $pdo = Database::getPDO();

        // ici j'execute ma requete sql ($sql) et je stock le resultat de cette requete dans $pdoStatement
        $pdoStatement = $pdo->query($sql);

        // Je veux récuperer UN objet Product, PDO le fait pour moi => fetchObject (fetch qu'une seule fois + converti en objet de la classe 'Product' donc le model Product)
        $type = $pdoStatement->fetchObject(type::class);

        return $type;
    }

    public function getName()
    {
        return $this->name;
    }


    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}