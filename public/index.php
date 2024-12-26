<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




// Ici j'inclus le fichier autoload.php car c'est grâce à ce fichier que je vais pouvoir inclure TOUTES mes dépendances composer (donc ce qu'il y a dans le dossier vendor)
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . '/../app/Controllers/MainController.php';

use App\Controllers\CatalogController;
use App\Controllers\MainController;

// Je créer une instance de AltoRouter (la librairie que j'ai installé)
$router = new AltoRouter();

// On fournit à AltoRouter la partie de l'URL à ne pa sprendre en compte pour faire la comparaison entre l'URL courante et l'url de la route
// LA valeur de $_SERVER['BASE_URI'] est donnée par le fichier .htaccess. Elle correspond au chemin de la racine du site, ici se termine par public
$router->setBasePath($_SERVER['BASE_URI']);



// Ici, je créer mes routes (https://altorouter.com/usage/mapping-routes.html)

// Ci dessous je dump(j'affiche) CatalogController::class
// CatalogController::class => c'est le nom complet de la classe CatalogController, cad que ca va afficher le namespace de cette classe + le nom de la classe => App\Controllers\CatalogController
//$router->addRoutes(array( 
   // array('GET','/', [
      //  'controller' => MainController::class, // Dans quel controller ?
       // 'action' => 'home' // Quelle méthode dans ce controller ?
   // ], 'home'),

    $router->addRoutes(array( 
        array('GET', '/', [
            'controller' => MainController::class,
            'action' => isset($_GET['route']) ? $_GET['route'] : 'home'
        ], 'dynamic-route'),
    
    
    array('GET','/mentions-legales', [
        'controller' => MainController::class, // le namespace nom de la classe + le nom de la classe (concatenation) 
        'action' => 'legalMentions'
    ], 'legal-mentions'),

    array('POST|GET', '/panier', [
        'controller' => MainController::class,
        'action' => 'panier'
    ], 'panier'),

    array('GET|POST','/register', [
        'controller' => MainController::class,
        'action' => 'register'
    ], 'register'),
    

    array('GET|POST', '/login', [
        'controller' => MainController::class,
        'action' => 'login'
    ], 'login'),

    array('GET', '/detail', [
        'controller' => MainController::class,
        'action' => 'detail'
    ], 'detail'),

    array('GET','/catalogue', [
        'controller' => MainController::class, // le namespace nom de la classe + le nom de la classe (concatenation) 
        'action' => 'catalogue'
    ], 'catalogue'),

    array('GET','/about', [
        'controller' => MainController::class, // le namespace nom de la classe + le nom de la classe (concatenation) 
        'action' => 'about'
    ], 'about'),

  
    array('GET', '/logout', [
        'controller' => MainController::class,
        'action' => 'logout'
    ], 'logout'),
    

    


    array('GET','/catalogue/categorie/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'Category'
    ], 'catalog-Category'),
    array('GET','/catalogue/type/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'type'
    ], 'catalog-type'),
    array('GET','/catalogue/marque/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'brand'
    ], 'catalog-brand'),
    array('GET','/catalogue/produit/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'Product'
    ], 'catalog-Product'),
    array('GET','/test', [
        'controller' => MainController::class,
        'action' => 'test'
    ])
  ));

  $match = $router->match(); // Vérifie si la route demandée existe

  // Log utile pour le débogage : route matchée ou non
  error_log("Route matchée : " . json_encode($match));
  
  if ($match !== false) {
      // Récupère le contrôleur et la méthode spécifiés pour cette route
      $controllerToUse = $match['target']['controller'];
      $methodToUse = $match['target']['action'];
  
      // Validation stricte du nom de la méthode pour éviter des appels imprévus
      $methodToUse = explode('/', $methodToUse)[0]; // Nettoie tout chemin supplémentaire
  
      // Logs pour suivre le déroulement de la requête
      error_log("URI demandée : " . $_SERVER['REQUEST_URI']);
      error_log("Données GET : " . json_encode($_GET));
      error_log("Données POST : " . json_encode($_POST));
      error_log("Méthode appelée : $methodToUse");
  
      // Vérifie si la méthode existe dans le contrôleur avant de l'appeler
      if (method_exists($controllerToUse, $methodToUse)) {
          error_log("Appel du contrôleur : $controllerToUse, Méthode : $methodToUse");
          $controller = new $controllerToUse();
          $controller->$methodToUse($match['params']); // Exécute la méthode avec les paramètres
      } else {
          // Erreur si la méthode n'existe pas
          error_log("La méthode $methodToUse n'existe pas dans le contrôleur $controllerToUse");
          throw new Exception("La méthode $methodToUse n'existe pas dans le contrôleur $controllerToUse");
      }
  } else {
      // Route non trouvée : affiche une page 404
      error_log("Aucune route correspondante trouvée pour : " . $_SERVER['REQUEST_URI']);
      header("HTTP/1.0 404 Not Found");
      echo "Page non trouvée";
      exit;
  }
  