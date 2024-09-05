<?php
define('SECURE', true);
require_once '../config/app.php';

// Récupérer les produits en vedette
$featuredProducts = $pdo->query("SELECT * FROM products WHERE is_active = 1 LIMIT 3")->fetchAll();

// Récupérer les catégories
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Votre site de vente d'iPhones</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Bienvenue sur notre boutique d'iPhones</h1>

    <h2>Produits en vedette</h2>
    <div class="row">
        <?php foreach ($featuredProducts as $product): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="images/<?= htmlspecialchars($product['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="card-text"><strong><?= htmlspecialchars($product['price']) ?> €</strong></p>
                        <a href="product.php?id=<?= $product['id'] ?>" class="btn btn-primary">Voir le produit</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Catégories</h2>
    <ul class="list-group">
        <?php foreach ($categories as $category): ?>
            <li class="list-group-item">
                <a href="category.php?id=<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
