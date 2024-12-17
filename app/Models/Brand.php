<?php

namespace App\Models;

use App\Utils\Database;
use PDO; // on utilise la classe PDO dont le namespace a été défini

class Brand extends CoreModel
{
    private $name;
   
    /**
     * Récupère toutes les marques (table Brand) depuis la base de données
     */
    public function findAll()
    {
        $sql = "SELECT * FROM Brand"; // Brand avec une majuscule
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);
        $brands = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Brand::class);

        return $brands;
    }

    /**
     * Récupère une seule marque en fonction de son id
     * Retourne un objet (une instance de la classe Brand)
     */
    public function find($id)
    {
        // Requête SQL pour récupérer une marque par son id
        $sql = "SELECT * FROM Brand WHERE id = ".$id; // Brand avec une majuscule

        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query($sql);

        // Récupère un objet Brand
        $brand = $pdoStatement->fetchObject(Brand::class);

        return $brand;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
