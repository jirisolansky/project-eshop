<form method="POST" enctype="multipart/form-data">

    <input type="text" name="name" placeholder="Název produktu" value="<?= htmlspecialchars($name) ?>"required><br><br>
    
    <input type="text" name="price" placeholder="Cena produktu" value="<?= htmlspecialchars($price) ?>"required><br><br>

    <textarea name="product_detail" placeholder="Popis produktu" required><?= htmlspecialchars($product_detail) ?></textarea><br><br><br>

    <input type="file" name="image" accept="image/*"><br><br><br><br>

    <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>"><br><br>

    <input type="submit" value="Uložit">

</form>