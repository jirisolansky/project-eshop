<?php

    require "assets/database.php";

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = $productId";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
        } else {
            echo "Produkt nebyl nalezen.";
            exit;
        }
    } else {
        echo "Chybí identifikátor produktu.";
        exit;
    }

    // Pokud se provede úprava produktu
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Získání nových informací o produktu z formuláře
        $name = $_POST['name'];
        $price = $_POST['price'];
        $product_detail = $_POST['product_detail'];

        // Zde by měla být provedena aktualizace databáze
        // Aktualizace dat v databázi může vypadat takto:
        $sql = "UPDATE products SET name = '$name', price = '$price', product_detail = '$product_detail' WHERE id = $productId";

        // Spuštění dotazu na databázi
        if (mysqli_query($connection, $sql)) {
            echo "Změny byly uloženy.";
        } else {
            echo "Chyba při ukládání změn: " . mysqli_error($connection);
        }
    }

    // Pokud se provede smazání produktu
    if (isset($_POST['delete'])) {
        $deleteSql = "DELETE FROM products WHERE id = $productId";
    
        if (mysqli_query($connection, $deleteSql)) {
            // Nastavení session proměnné s informací o smazání produktu
            session_start();
            $_SESSION['deleted_product'] = true;
    
            // Přesměrování na stránku all-products.php po úspěšném smazání produktu
            header("Location: all-products.php");
            exit; // Ukončení skriptu, aby nedošlo k dalšímu zpracování
        } else {
            echo "Chyba při mazání produktu: " . mysqli_error($connection);
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
    <section class="edit-form">
            <h1>Editace produktu</h1>

            <!-- Formulář pro editaci produktu -->
            <form action="edit-product.php?id=<?php echo $productId; ?>" method="POST">
                <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>
                <input type="text" name="price" value="<?php echo $product['price']; ?>" required><br><br>
                <textarea name="product_detail"><?php echo $product['product_detail']; ?></textarea><br><br><br>
                <input type="submit" value="Uložit změny">
            </form>

            <!-- Tlačítko pro smazání produktu s potvrzením -->
            <form action="" method="POST">
                <input type="hidden" name="delete" value="true">
                <input type="submit" value="Smazat produkt" onclick="return confirm('Opravdu chcete smazat tento produkt?')">
            </form>
        </section>
    </main>

    <footer>
        <?php require "assets/footer.php"; ?>
    </footer>
</body>
</html>