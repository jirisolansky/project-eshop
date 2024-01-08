<?php

    require "assets/database.php";

    // echo "Úspěšné přihlášení do databáze.";

    
    $sql = "SELECT *
            FROM products";

    $result = mysqli_query($connection, $sql);
    
    if ($result === false) {
        echo mysqli_error($connection);
    } else {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // var_dump($students);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all-products.css">
    <title>Document</title>
</head>
<body>

    <header>
        <?php require "assets/header.php"; ?>
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
                                <img src="<?php echo $one_product["image"]; ?>" alt="<?php echo $one_product["name"]; ?>">
                                <h2><?php echo $one_product["name"]; ?></h2>
                                <p>Cena: <?php echo $one_product["price"]; ?> Kč</p>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
        
    </main>

    <footer>
        <?php require "assets/footer.php"; ?>
    </footer>
</body>

</html>