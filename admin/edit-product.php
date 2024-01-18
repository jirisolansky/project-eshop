<?php

    require "../assets/database.php";
    require "../assets/product.php";

    $connection = connectionDB();

    if (isset($_GET['id'])) {
        $one_product = getProduct($connection, $_GET['id']);

        if ($one_product) {
            $name = $one_product["name"];
            $price = $one_product["price"];
            $product_detail = $one_product["product_detail"];
            $image = $one_product["image"];
            $id = $one_product["id"];
        } else {
            die("Product nenalezen.");
        }
    } else {
        die("ID produktu nebylo zadáno. Produkt nenalezen.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $product_detail = $_POST["product_detail"];
        
        // Podmínka, která kontroluje, zda byl soubor nahrán bez chyby.
        // UPLOAD_ERR_OK je konstanta, která znamená, že nenastala žádná chyba při nahrávání.
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            $fileName = $_FILES['image']['name']; // Získává jméno nahrávaného souboru z asociativního pole $_FILES.
            $filePath = $uploadDir . $fileName; // Spojuje cestu k adresáři s názvem souboru a vytváří úplnou cestu, kde bude soubor uložen.

            // Funkce move_uploaded_file přesune nahrávaný soubor z dočasného umístění ('tmp_name') na konečnou cestu ($filePath).
            if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                // Nastavuje proměnnou $image na novou cestu k obrázku.
                $image = $filePath;
            } else {
                echo "Obrázek se nepodařilo nahrát.";
            }
        }

        updateProduct($connection, $name, $price, $product_detail, $image, $id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editovat produkt</title>
</head>
<body>
    <header>
        <?php require "../assets/header.php"; ?>
    </header>
    
    <main>
        <section class="edit-form">
            <h1>Editace produktu</h1>
            <?php require "../assets/form-product.php"; ?>
        </section>
    </main>

    <footer>
        <?php require "../assets/footer.php"; ?>
    </footer>
</body>
</html>