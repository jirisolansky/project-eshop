<?php

    require "../assets/database.php";
    require "../assets/product.php";

    $connection = connectionDB();
    
    if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
        // Funkce sice vytáhne informace ale vrací je, takže se to musí uložit do proměnné 
        $product = getProduct($connection, $_GET["id"]);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/one-product.css">
    <title>Jeden produkt</title>
</head>
<body>

    <header>
        <?php require "../assets/header.php"; ?>
    </header>

    <main>

        <section class="product-page">
            <h1>Informace o produktu</h1>
            <?php if($product === null): ?>
                <p>Produkt nenalezen nebo neplatné ID produktu.</p>
            <?php else: ?>
                <img src="<?= htmlspecialchars($product["image"]); ?>" alt="<?= htmlspecialchars($product["name"]); ?>">
                <h2><?= htmlspecialchars($product["name"]); ?></h2>
                <p><?= htmlspecialchars($product["product_detail"]); ?></p>
                <p class="price">Cena: <?= htmlspecialchars($product["price"]); ?>,- Kč</p>
            <?php endif ?>
        </section>

        <section class="buttons">
            <a href="edit-product.php?id=<?= $product['id']?>" class="edit">Editovat produkt</a>
            <a href="delete-product.php?id=<?= $product['id']?>" class="delete">Vymazat produkt</a>
        </section>
    </main>

    <footer>
        <?php require "../assets/footer.php"; ?>
    </footer>
</body>
</html>