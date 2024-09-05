<?php

// Chargement automatique de Composer
require_once __DIR__ . '/vendor/autoload.php';

// Enregistrement d'un autoloader personnalisé pour les contrôleurs, modèles, etc.
spl_autoload_register(function ($class) {
    // Définition des namespaces et des chemins correspondants
    $prefixes = [
        'App\\Controllers\\' => __DIR__ . '/app/Controllers/',
        'App\\Models\\'      => __DIR__ . '/app/Models/',
        'App\\Views\\'       => __DIR__ . '/app/Views/',
    ];

    // Vérification et inclusion du fichier de classe
    foreach ($prefixes as $prefix => $baseDir) {
        if (strncmp($prefix, $class, strlen($prefix)) === 0) {
            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }
});
