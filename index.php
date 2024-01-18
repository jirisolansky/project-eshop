<?php

require "assets/database.php";
require "assets/product.php"; 

$connection = connectionDB();
$products = getAllProducts($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <title>Úvodní strana</title>
</head>
<body>
    
    <header>
        <?php require "assets/header.php"; ?>
    </header>

    <main>
        <section class="textWithBackground">
            <div class="banner">
                <div class="intro-container">
                    <h1>Winter sale</h1>
                    <p>Kopačky se slevou až 30 %</p>
                    <button><span></span>Akce</button>
                </div>
            </div>
        </section>

        <section class="favorite-products">
            <h2>Oblíbené produkty</h2>

            <div class="carousel-container">
                <div class="carousel-track" id="carouselTrack">

                    <?php foreach ($products as $product): ?>
                    <div class="carousel-item">
                        <!-- Obsah jednoho produktu, například: -->
                        <img src="./uploads/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                        <h4><?= htmlspecialchars($product['name']); ?></h4>
                        <p><?= htmlspecialchars($product['price']); ?> Kč</p>
                    </div>
                    <?php endforeach; ?>

                </div>

                <!-- Navigační šipky -->
                <button class="carousel-button-prev" id="prevButton">&#10094;</button>
                <button class="carousel-button-next" id="nextButton">&#10095;</button>
            </div>

        </section>
        
    </main>

    <footer>
        <?php require "assets/footer.php"; ?>
    </footer>

    <script src="js/index.js"></script>
</body>
</html>