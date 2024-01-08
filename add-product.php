<?php

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['image'])) {
        $uploadDir = 'uploads/'; // Adresář pro uložení nahraných obrázků

        $fileName = $_FILES['image']['name'];
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
            require "assets/database.php"; // Připojení k databázi

            $sql = "INSERT INTO products (name, price, product_detail, image)
                    VALUES (?, ?, ?, ?)";
            $statement = mysqli_prepare($connection, $sql);

            if ($statement === false) {
                echo mysqli_error($connection);
            } else {
                mysqli_stmt_bind_param($statement, "siss", 
                    $_POST["name"], 
                    $_POST["price"], 
                    $_POST["product_detail"], 
                    $filePath); // Přidání cesty k obrázku

                if (mysqli_stmt_execute($statement)) {
                    $id = mysqli_insert_id($connection);
                    echo "Produkt byl úspěšně přidán (id produktu: $id).";
                } else {
                    echo mysqli_stmt_error($connection);
                }
            }
        } else {
            echo "Produkt se nepodařilo přidat.";
        }
    }
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
        <section class="add-form">
            <h1>Přidat nový produkt</h1>

            <form action="add-product.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Název produktu" required><br><br>
                <input type="text" name="price" placeholder="Cena produktu" required><br><br>
                <textarea name="product_detail" placeholder="Popis produktu"></textarea><br><br><br>
                <input type="file" name="image" required><br><br><br><br>
                <input type="submit" value="Přidat produkt">
            </form>
        </section>
    </main>

    <footer>
        <?php require "assets/footer.php"; ?>
    </footer>
</body>
</html>
