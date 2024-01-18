<?php

    require "../assets/database.php";
    require "../assets/product.php";

    $connection = connectionDB();

    $products = getAllProducts($connection);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/all-products.css">
    <title>Všechny produkty</title>
</head>
<body>

    <header>
        <?php require "../assets/header.php"; ?>
    </header>

    <main>
        <section class="products">
            <h1>Seznam všech produktů</h1>

            <?php if(empty($products)): ?>
                <p>Žádné produkty nebyly nalezeny</p>
            <?php else: ?>
                <ul>
                    <?php foreach($products as $one_product): ?>
                        <li>
                            <a href="one-product.php?id=<?= $one_product['id'] ?>">
                                <img src="<?= htmlspecialchars($one_product["image"]); ?>" alt="<?= htmlspecialchars($one_product["name"]); ?>">
                                <h2><?= htmlspecialchars($one_product["name"]); ?></h2>
                                <p><?= htmlspecialchars($one_product["price"]); ?> Kč</p>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
        
    </main>

    <footer>
        <?php require "../assets/footer.php"; ?>
    </footer>
</body>

</html>