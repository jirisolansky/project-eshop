<?php

    require "../assets/database.php";
    // require "../assets/url.php";
    require "../assets/product.php";

    $connection = connectionDB();

    $name = null;
    $price = null;
    $product_detail = null;
    $image = null;

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['image'])) {
        
        $name = $_POST['name'];
        $price = $_POST['price'];
        $product_detail = $_POST['product_detail'];
        
        addProduct($connection, $name, $price, $product_detail, $filePath);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat produkt</title>
</head>
<body>
    <header>
        <?php require "../assets/header.php"; ?>
    </header>
    
    <main>
        <section class="add-form">
            <h1>Přidat nový produkt</h1>
            <?php require "../assets/form-product.php"; ?>
        </section>
    </main>

    <footer>
        <?php require "../assets/footer.php"; ?>
    </footer>
</body>
</html>
