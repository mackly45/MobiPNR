<?php

// Chargement automatique des classes avec Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Chargement des variables d'environnement
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Configuration de l'application
return [
    'app_name' => $_ENV['APP_NAME'] ?? 'Vente iPhones',
    'base_url' => $_ENV['BASE_URL'] ?? 'http://localhost',
    'debug' => $_ENV['APP_DEBUG'] ?? true,
    'log_file' => __DIR__ . '/../logs/app.log',
    
    // Configuration de la base de données
    'db' => [
        'driver' => 'mysql',
        'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
        'database' => $_ENV['DB_DATABASE'] ?? 'vente_iphones',
        'username' => $_ENV['DB_USERNAME'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
    ],
    
    // Configuration des sessions
    'session' => [
        'name' => 'app_session',
        'lifetime' => 7200, // Durée de la session en secondes (2 heures)
        'path' => '/',
        'domain' => $_ENV['SESSION_DOMAIN'] ?? null,
        'secure' => $_ENV['SESSION_SECURE'] ?? false,
        'httponly' => true,
        'samesite' => 'Lax',
    ],
    
    // Configuration des cookies
    'cookies' => [
        'lifetime' => 604800, // Durée de vie des cookies en secondes (7 jours)
        'path' => '/',
        'domain' => $_ENV['COOKIE_DOMAIN'] ?? null,
        'secure' => $_ENV['COOKIE_SECURE'] ?? false,
        'httponly' => true,
        'samesite' => 'Lax',
    ],
    
    // Configuration du journal des logs
    'logger' => [
        'name' => 'app',
        'path' => __DIR__ . '/../logs/app.log',
        'level' => $_ENV['LOG_LEVEL'] ?? \Monolog\Logger::DEBUG,
    ],

    // Configuration du système de paiement
    'payment_methods' => [
        'mtn_momo' => 'MTN Mobile Money',
        'credit_card' => 'Credit Card',
    ]
];
