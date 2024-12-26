<?php

namespace App\Controllers;
use App\Utils\Database;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
        
            // Récupérer les catégories
            $categoryModel = new Category();
            $categories = $categoryModel->findAll();
            

        
            // Récupérer tous les produits
            $productModel = new Product();
            $allProducts = $productModel->findAll();
          


        
            // Produits filtrés par catégorie
            $products = [];
            $productDetails = null;
            $categoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : null;
        
            // Gérer l'état de "désélection"
            if (isset($_SESSION['selected_category']) && $_SESSION['selected_category'] == $categoryId) {
                unset($_SESSION['selected_category']);
            } else {
                $_SESSION['selected_category'] = $categoryId;
        
                // Récupérer les produits pour la catégorie sélectionnée
                if ($categoryId) {
                    $products = $productModel->findByCategory($categoryId);
                }
            }
        
            // Vérifie si un produit est sélectionné
            if (!empty($_GET['product_id'])) {
                $productId = (int) $_GET['product_id'];
                $productDetails = $productModel->find($productId);
            }
        
            // Transmettre les données à la vue
            $this->show('catalogue', [
                'categories' => $categories,
                'products' => $products,
                'selected_category' => $categoryId,
                'productDetails' => $productDetails,
                'allProducts' => $allProducts, // Transmet tous les produits à la vue
            ]);
        }
           
      public function productList()
      {
          // Crée une instance du modèle Product
          $productModel = new Product();
      
          // Récupère tous les produits depuis la base de données
          $products = $productModel->findAll();
      
        
      
          // Transmet les produits récupérés à la vue 'product_list'
          $this->show('product_list', [
              'products' => $products // Tableau associatif contenant les produits
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

    public function panier() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $action = $_GET['action'] ?? null;

            switch ($action) {
                case 'add':
                    $productId = intval($_GET['product_id'] ?? 0);
                    $productName = htmlspecialchars($_GET['product_name'] ?? '');
                    $productPrice = floatval($_GET['product_price'] ?? 0);
                    $productPicture = htmlspecialchars($_GET['product_picture'] ?? 'default.jpg');

                    if ($productId > 0 && $productName && $productPrice > 0) {
                        if (!isset($_SESSION['panier'])) {
                            $_SESSION['panier'] = [];
                        }

                        $found = false;
                        foreach ($_SESSION['panier'] as &$item) {
                            if ($item['id'] === $productId) {
                                $item['quantity']++;
                                $found = true;
                                break;
                            }
                        }

                        if (!$found) {
                            $_SESSION['panier'][] = [
                                'id' => $productId,
                                'name' => $productName,
                                'price' => $productPrice,
                                'quantity' => 1,
                                'image' => $productPicture,
                            ];
                        }
                    }

                    header("Location: /panier");
                    exit();

                case 'remove':
                    $productId = intval($_GET['product_id'] ?? 0);
                    if ($productId > 0 && isset($_SESSION['panier'])) {
                        foreach ($_SESSION['panier'] as $index => $item) {
                            if ($item['id'] === $productId) {
                                unset($_SESSION['panier'][$index]);
                                $_SESSION['panier'] = array_values($_SESSION['panier']);
                                break;
                            }
                        }
                    }
                    header("Location: /panier");
                    exit();

                case 'update':
                    $productId = intval($_GET['product_id'] ?? 0);
                    $quantity = intval($_GET['quantity'] ?? 0);

                    if ($productId > 0 && $quantity > 0 && isset($_SESSION['panier'])) {
                        foreach ($_SESSION['panier'] as &$item) {
                            if ($item['id'] === $productId) {
                                $item['quantity'] = $quantity;
                                break;
                            }
                        }
                    }
                    header("Location: /panier");
                    exit();
            }
        }

        $cart = $_SESSION['panier'] ?? [];

        $this->show('panier', ['panier' => $cart]);
    }

    
    // Page "register"
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement des données soumises
            $nom = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            if (empty($nom) || empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } else {
                $pdo = Database::getPDO();
                $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $existingUser = $stmt->fetch();

                if ($existingUser) {
                    $error = "L'email est déjà utilisé.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (:nom, :email, :password)");
                    $stmt->execute([
                        'nom' => $nom,
                        'email' => $email,
                        'password' => $hashed_password
                    ]);

                    header("Location: /login");
                    exit;
                }
            }

           
            $this->show('register', ['error' => $error ?? null]);
        } else {
            
            $this->show('register');
        }
    

    }
    

    // Page "login"
    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des données envoyées par le formulaire
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        if (empty($email) || empty($password)) {
            $error = "Veuillez remplir tous les champs.";
        } else {
            
            $pdo = \App\Utils\Database::getPDO();

            // Recherche de l'utilisateur avec l'email
            $stmt = $pdo->prepare("SELECT id, nom, password FROM utilisateurs WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Démarrage de la session et stockage des informations utilisateur
             
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['nom'];

               
                header("Location: /");
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }

      
        $this->show('login', ['error' => $error ?? null]);
    } else {
       
        $this->show('login');
    }
}

public function logout()
{
   
    session_destroy(); 
    header("Location: /"); // Redirige vers l'accueil
    exit;
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