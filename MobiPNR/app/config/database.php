<?php
// Empêcher l'accès direct à ce fichier
if (!defined('SECURE')) {
    die('Direct access not permitted');
}

// Paramètres de connexion à la base de données
define('DB_HOST', 'localhost'); // Remplacez par votre hôte de base de données
define('DB_NAME', 'vente_iphones'); // Nom de votre base de données
define('DB_USER', 'root'); // Nom d'utilisateur MySQL
define('DB_PASSWORD', 'votre_mot_de_passe'); // Mot de passe MySQL

// Options PDO pour une sécurité accrue
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer les exceptions pour les erreurs
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Récupérer les résultats sous forme de tableau associatif
    PDO::ATTR_EMULATE_PREPARES => false, // Désactiver l'émulation des requêtes préparées (plus sûr)
];

// Fonction pour établir une connexion sécurisée à la base de données
function getDatabaseConnection() {
    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        return new PDO($dsn, DB_USER, DB_PASSWORD, $GLOBALS['options']);
    } catch (PDOException $e) {
        // Ne pas afficher l'erreur en production, mais journaliser de manière sécurisée
        error_log('Connection error: ' . $e->getMessage());
        die('Database connection error'); // Message générique pour l'utilisateur
    }
}

// Sécuriser les variables globales
function secureInput($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Démarrer une session sécurisée
function startSecureSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        // Régénérer l'identifiant de session pour éviter les attaques de fixation de session
        session_regenerate_id(true);
    }
}

// Fonction pour vérifier si l'utilisateur est connecté
function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

// Définir des en-têtes de sécurité
header('X-Frame-Options: DENY'); // Empêcher l'intégration dans des frames (protection contre les attaques de clickjacking)
header('X-Content-Type-Options: nosniff'); // Éviter les interprétations incorrectes de types de contenu
header('X-XSS-Protection: 1; mode=block'); // Activer la protection contre les attaques XSS
header('Referrer-Policy: no-referrer'); // Limiter l'envoi du référent

// Définir un secret pour CSRF (anti-falsification des requêtes)
define('CSRF_SECRET', bin2hex(random_bytes(32)));

// Assurer la compatibilité avec HTTPS
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', '1'); // Utiliser des cookies sécurisés en HTTPS
}

// Définir des paramètres de cookie sécurisés
ini_set('session.cookie_httponly', '1'); // Éviter l'accès JavaScript aux cookies
ini_set('session.cookie_samesite', 'Strict'); // Protéger contre les attaques CSRF

?>
