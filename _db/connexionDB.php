<?php

class connexionDB
{
  // Définition des paramètres de connexion par défaut
  private $host = 'localhost';
  private $name = 'formulaire_inscription_connexion';
  private $user = 'root';
  private $pass = '';
  private $connexion;

  // Constructeur de la classe
  function __construct($host = null, $name = null, $user = null, $pass = null)
  {
    // Vérifie si des paramètres de connexion ont été fournis, sinon utilise les paramètres par défaut
    if ($host != null) {
      $this->host = $host;
      $this->name = $name;
      $this->user = $user;
      $this->pass = $pass;
    }
    try {
      // Création d'une connexion à la base de données en utilisant PDO
      $this->connexion = new PDO(
        'mysql:host=' . $this->host . ';dbname=' . $this->name,
        $this->user,
        $this->pass,
        array(
          // Configuration supplémentaire pour PDO
          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8MB4', // Définit l'encodage des caractères à UTF-8
          PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // Active le mode de rapport d'erreurs
        )
      );
    } catch (PDOException $e) {
      // En cas d'erreur lors de la connexion, affiche un message d'erreur et arrête l'exécution du script
      echo 'Erreur : Impossible de se connecter a la BDD !';
      die();
    }
  }

  // Méthode permettant de récupérer la connexion à la base de données
  public function DB()
  {
    return $this->connexion;
  }
}

$DBB = new connexionDB();

$DB = $DBB->DB();
