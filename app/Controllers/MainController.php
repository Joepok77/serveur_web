<?php

namespace App\Controllers;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;


class MainController extends CoreController
{

    public function test()
    {
        $brandModel = new Brand(); // peut modifier Brand avec les autres nom de model pour tester
        $list = $brandModel->findAll();
        $elem = $brandModel->find(7);
        dump($list);
        dump($elem);
    }
    /**
     * Affiche la page d'accueil du site
     */
    public function home()
    {
        // Ci dessous je créer une instance du model Category
        $categoryModel = new Category();
        // Ensuite j'execute la fonction findAllForHomePage() du model Category
        $categories = $categoryModel->findAllForHomePage();
        // dump($categories);
        $this->show('home', [
            'categories' => $categories
        ]);
    }

      // Page "catalogue"
      public function catalogue()
      {
          $categoryModel = new Category();
          $categories = $categoryModel->findAll();
      
          $products = [];
          $productDetails = null;
          $categoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : null;
      
          // Gérer l'état de "désélection"
          if (session_status() === PHP_SESSION_NONE) {
              session_start();
          }
      
          if (isset($_SESSION['selected_category']) && $_SESSION['selected_category'] == $categoryId) {
              unset($_SESSION['selected_category']);
          } else {
              $_SESSION['selected_category'] = $categoryId;
      
              // Récupérer les produits pour la catégorie sélectionnée
              if ($categoryId) {
                  $productModel = new Product();
                  $products = $productModel->findByCategory($categoryId);
              }
          }
      
          // Vérifie si un produit est sélectionné
          if (!empty($_GET['product_id'])) {
              $productId = (int) $_GET['product_id'];
              $productModel = new Product();
              $productDetails = $productModel->find($productId);
          }
      
          $this->show('catalogue', [
              'categories' => $categories,
              'products' => $products,
              'selected_category' => $categoryId,
              'productDetails' => $productDetails
          ]);
      }
      

      
      
      
      
  

    /**
     * Show legal mentions page
     */
    public function legalMentions()
    {
        // Affiche la vue dans le dossier views
        $this->show('mentions');
    }



    // Page "About"
    public function about()
    {
        $this->show('about');
    }

    // Page "panier"
    public function panier()
    {
        $this->show('panier');
    }

    // Page "register"
    public function register()
    {
        $this->show('register');
    }

    // Page "login"
    public function login()
    {
        $this->show('login');
    }



    // Page "detail"
    public function detail()
    {
        if (!empty($_GET['product_id'])) {
            $productId = (int) $_GET['product_id'];
    
            $productModel = new Product();
            $product = $productModel->find($productId);
    
            $this->show('detail', [
                'product' => $product
            ]);
        } else {
            // Redirection ou message d'erreur si product_id est manquant
            header('Location: index.php?route=catalogue');
            exit;
        }
    }
    
}