<?php

    require "assets/database.php";


    // echo "Úspěšné přihlášení do databáze.";

    if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
        $sql = "SELECT *
            FROM products
            WHERE id = ". $_GET["id"];

        $result = mysqli_query($connection, $sql);
    
        if ($result === false) {
        echo mysqli_error($connection);
        } else {
        $products = mysqli_fetch_assoc($result);
        }
    }

    
    // var_dump($products["name"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <header>
        <?php require "assets/header.php"; ?>
    </header>

    <main>
        <section class="main-heading">
            <h1>Informace o produktu</h1>
        </section>

        <section class="info">
            <?php if($products === null): ?>
                <p>Produkt nenalezen nebo neplatné ID produktu.</p>
            <?php else: ?>
                <img src="<?php echo $products["image"]; ?>" alt="<?php echo $products["name"]; ?>">
                <h2><?php echo $products["name"]; ?></h2>
                <p><?php echo $products["product_detail"]; ?></p>
                <p><?php echo $products["price"]; ?></p>
            <?php endif ?>
        </section>

        <section class="buttons">
            <a href="edit-product.php?id=<?= $products['id']?>">Editovat</a>
        </section>
    </main>

    <footer>
        <?php require "assets/footer.php"; ?>
    </footer>
</body>
</html>