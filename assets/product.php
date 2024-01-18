<?php

    require "url.php";

/**
 * 
 * Získá jeden produkt z databáze podle ID
 * 
 * @param object $connection - napojení na databázi
 * @param integer $id - id jednoho konkrétního produktu
 * 
 * @return mixed asociativní pole, které obsahuje informace o jednom konkrétním produktu nebo vrátí null, pokud produkt nebyl nalezen
 * 
 */
 
function getProduct($connection, $id) {
    $sql = "SELECT *
            FROM products
            WHERE id = ?";

    // Příprava na exekuci
    $stmt = mysqli_prepare($connection, $sql);

    // Pokud false, tak vypiš chybu. Pokud true, tak mi nahraď ten otazník reálnou hodnoutou.
    if($stmt === false){
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
      
        // Pokud se to provede správně, vrať mi ty informace do resultu a převeď mi to na ASSOC pole
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}




/**
 * 
 * Updatuje informace o produktu v databázi
 * 
 * @param object $connection - napojení na databázi
 * @param string $name - název produktu
 * @param integer $price - cena produktu
 * @param string $produt_detail - popis produktu
 * @param string $image - obrázek produktu
 * @param integer $id - id produktu
 * 
 * @return void
 * 
 */

function updateProduct($connection, $name, $price, $product_detail, $image, $id){

    $sql = "UPDATE products
                SET name = ?,
                    price = ?,
                    product_detail = ?,
                    image = ?
                WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "sissi", $name, $price, $product_detail, $image, $id);

        if (mysqli_stmt_execute($stmt)) {

            redirectUrl("/project-eshop/admin/one-product.php?id=$id");

        } else {
            echo mysqli_stmt_error($stmt);
        }
    }
}




/**
 * 
 * Vymaže produkt z databáze podle daného ID
 * 
 * @param object $connection - propojení s databází
 * @param integer $id - id daného produktu
 * 
 * @return void
 */

function deleteProduct($connection, $id){
    $sql = "DELETE
            FROM products
            WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if(!$stmt) {
        echo mysqli_error ($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if(mysqli_stmt_execute($stmt)) {
            redirectUrl("/project-eshop/admin/all-products.php");
        }
    }
}




/**
 * 
 * Zobrazí všechny produkty z databáze
 * 
 * @param object $connection - připojení do databáze
 * @return array pole objektů, kde každý objekt je jeden produkt
 *  
 */

function getAllProducts($connection) {
    $sql = "SELECT *
            FROM products";

    $result = mysqli_query($connection, $sql);
    
    if (!$result) {
        echo mysqli_error($connection);
    } else {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $products;
    }
    
}




/**
 * 
 * Přidání produktu do databáze a přesměruje na kartu produktu
 * 
 * @param object $connection - napojení na databázi
 * @param string $name - název produktu
 * @param integer $price - cena produktu
 * @param string $produt_detail - popis produktu
 * @param string $filePath - cesta k obrázku + název obrázku
 * 
 * @return void
 * 
 */

function addProduct($connection, $name, $price, $product_detail, $filePath){
    $uploadDir = '../uploads/';
    $fileName = $_FILES['image']['name'];
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {

        $sql = "INSERT INTO products (name, price, product_detail, image)
                VALUES (?, ?, ?, ?)";
                
        $stmt = mysqli_prepare($connection, $sql);

        if (!$stmt) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($stmt, "siss", $name, $price, $product_detail, $filePath);

            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($connection);

                redirectUrl("/project-eshop/admin/one-product.php?id=$id");

            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    } else {
        echo "Produkt se nepodařilo přidat.";
    }
}