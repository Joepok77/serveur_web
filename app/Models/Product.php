<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Product extends CoreModel
{
    private $name;
    private $description;
    private $picture;
    private $price;
    private $rate;
    private $status;
    private $brand_id;
    private $category_id;
    private $type_id;

    /**
     * Récupère tous les produits depuis la BDD
     */
    public function findAll()
    {
        $sql = "SELECT * FROM Product";
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Product::class);
    }

    /**
     * Récupère tous les produits avec leur catégorie
     */
    public function findAllWithCategories()
    {
        $sql = "
            SELECT Product.*, category.name AS category_name
            FROM product
            JOIN category ON product.category_id = category.id
            ORDER BY category.name
        ";

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);
        return $pdoStatement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupère les produits par catégorie
     */
    public function findByCategory($categoryId)
    {
        $sql = "SELECT * FROM Product WHERE category_id = :category_id";
    
        $pdo = Database::getPDO();
        $query = $pdo->prepare($sql);
        $query->execute(['category_id' => $categoryId]);
    
        return $query->fetchAll(PDO::FETCH_CLASS, Product::class);
    }
    
    /**
     * Récupère les produits par type
     */
    public function findByType($id_type)
    {
        $sql = "SELECT * FROM product WHERE type_id = :type_id";
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':type_id', $id_type, PDO::PARAM_INT);
        $pdoStatement->execute();
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Product::class);
    }

    /**
     * Récupère les produits par marque
     */
    public function findByBrand($id_brand)
    {
        $sql = "SELECT * FROM product WHERE brand_id = :brand_id";
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':brand_id', $id_brand, PDO::PARAM_INT);
        $pdoStatement->execute();
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Product::class);
    }

    /**
     * Récupère un produit par son ID
     */
    public function find($id)
    {
        $sql = "SELECT * FROM Product WHERE id = :id";
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        return $pdoStatement->fetchObject(Product::class);
    }

    // --- Getters et Setters ---
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

        /**
         * Get the value of description
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        /**
         * Get the value of picture
         */
        public function getPicture()
        {
            return $this->picture;
        }

        /**
         * Get the value of price
         */
        public function getPrice()
        {
            return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */
        public function setPrice($price)
        {
            $this->price = $price;
        }

        /**
         * Get the value of rate
         */
        public function getRate()
        {
            return $this->rate;
        }

        /**
         * Get the value of status
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */
        public function setStatus($status)
        {
            $this->status = $status;
        }

        /**
         * Get the value of brand_id
         */
        public function getBrand_id()
        {
            return $this->brand_id;
        }

        /**
         * Set the value of brand_id
         *
         * @return  self
         */
        public function setBrand_id($brand_id)
        {
            $this->brand_id = $brand_id;
        }

        /**
         * Get the value of category_id
         */
        public function getCategory_id()
        {
            return $this->category_id;
        }

        /**
         * Set the value of category_id
         *
         * @return  self
         */
        public function setCategory_id($category_id)
        {
            $this->category_id = $category_id;
        }

        /**
         * Get the value of type_id
         */ 
        public function getType_id()
        {
            return $this->type_id;
        }

        /**
         * Set the value of type_id
         *
         * @return  self
         */ 
        public function setType_id($type_id)
        {
            $this->type_id = $type_id;
        }
    }