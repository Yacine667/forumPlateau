<?php
$topic = ($result["data"]['topic']);
?>

<h1>Modifier Le Sujet</h1>

<form method="post">
    <p><br>
        <label>
            Modifier le titre : <br>
            <input type="text" name="title" value="<?= $topic->getTitle()?>">
        </label>
    </p><br>
        <input type="submit" value="Modifier">
</form>