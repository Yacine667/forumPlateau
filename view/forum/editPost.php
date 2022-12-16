<?php
$post = ($result["data"]['post']);
?>

<h1>Modification du message</h1>

<form method="post">
    <label>
        Modifier votre message :<br>
        <textarea class="ajout" name="message"><?= $post->getMessage()?></textarea>
    </label>
    <br>
    <input type="submit" value="Modifier">
</form>