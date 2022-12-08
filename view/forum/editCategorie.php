<?php
$categorie = ($result["data"]['categorie']);
?>

<h1>Modification de la catégorie : </h1>

<form method="post">
    <p>
        <label>
            Modifier le nom de la catégorie : <br>
            <input type="text" name="nomCategorie" value="<?= $categorie->getNomCategorie()?>">
        </label>
    </p><br>
        <input type="submit" value="Modifier">
</form>