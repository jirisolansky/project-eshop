<?php

    require "../assets/database.php";
    require "../assets/product.php";

    $connection = connectionDB();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        deleteProduct($connection, $_GET["id"]);
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Smazat žáka</title>
    </head>
    <body>
        <header>
            <?php require "../assets/header.php"; ?>
        </header>
        
        <main>
            <section class="delete-form">
                <form method="POST">
                    <p>Opravdu chcete tento produkt smazat?</p>
                    <button>Ano, smazat</button>
                    <a href="one-product.php?id=<?= $_GET['id'] ?>">Ne, vrátit se zpět</a>
                </form>
            </section>
        </main>

        <footer>
            <?php require "../assets/footer.php"; ?>
        </footer>
        
    </body>
    </html>

    