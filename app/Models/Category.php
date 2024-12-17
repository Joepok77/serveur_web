<?php

namespace App\Models;

use App\Utils\Database;
use PDO; // on utilise la classe PDO dont le namespace a été défini

class Category extends CoreModel
{
    private $name;
    private $subtitle;
    private $picture;
    private $home_order; // ordre d'affichage des catégories dans la page accueil

    /**
     * Récupère toutes les catégories (table Category) depuis la bdd
     * Retourne une liste d'objet (instances de la classe Category => le model ou on est)
     */
    public function findAll()
    {
        $sql = "SELECT * FROM Category ORDER BY name"; // "Category" en majuscule

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Category::class);
    }


    /**
     * Récupère une seule catégorie en fonction de son id
     * Retourne un objet (une instance de la classe Category => le model ou on est)
     */
    public function find($id)
    {
        // Ici on créer la requête SQL qui va récupérer la catégorie en fonction de son id
        $sql = "SELECT * FROM Category WHERE id = ".$id; // "Category" en majuscule

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        $category = $pdoStatement->fetchObject(Category::class);

        return $category;
    }

    /**
     * Récupère toutes les catégories qui ont un home_order > 0 et rangées dans l'ordre de home_order
     */
    public function findAllForHomePage()
    {
        $sql = "SELECT * FROM Category WHERE home_order > 0 ORDER BY home_order"; // "Category" en majuscule

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Category::class);
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

    /**
     * Get the value of subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     * @return self
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get Picture
     *
     * @return void
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return self
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */
    public function getHome_order()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * @return self
     */
    public function setHome_order($home_order)
    {
        $this->home_order = $home_order;
    }
}
