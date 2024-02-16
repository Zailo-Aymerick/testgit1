<?php
class DBconnect
{
    // Attribut statique pour stocker l'unique instance de la classe
    private static $instance = null;

    // Attribut pour stocker l'objet PDO représentant la connexion à la base de données
    private PDO $connexion;

    // Constructeur prenant les informations de connexion à la base de données
    public function __construct(
        string $dsn,
        string $username,
        string  $password
    ) {
        // on essaye d'établir une connexion en instenciant un objet PDO
        try {
            // Initialisation de la connexion PDO avec les informations fournies
            $this->connexion = new PDO($dsn, $username, $password);
            // Configuration du mode d'erreur sur PDO::ERRMODE_EXCEPTION
            $this->connexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            // En cas d'erreur, affichage du message d'erreur et arrêt du script
            echo $e->getMessage();
            die();
        }
    }

    // Méthode pour récupérer l'objet PDO de la connexion à la base de données
    public function getConnexion()
    {
        return $this->connexion;
    }

    // Méthode statique pour obtenir l'unique instance de la classe
    public static function getInstance($dsn, $username, $password)
    {
        // Vérification si aucune instance n'existe déjà
        if (is_null(self::$instance)) {
            try {
                // Création d'une nouvelle instance de la classe avec les informations de connexion fournies
                self::$instance = new DBconnect(
                    $dsn,
                    $username,
                    $password
                );
            } catch (PDOException $e) {
                // En cas d'erreur, affichage du message d'erreur
                echo $e->getMessage();
            }
        }
        // Retour de l'instance créée
        return self::$instance;
    }
}
