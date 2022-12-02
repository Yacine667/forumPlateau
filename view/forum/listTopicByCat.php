<?php

$topics = (!$result["data"]['topics']) ? [] : $result["data"]['topics'];

    
?>

<h1>Liste Des Sujets Par Catégorie</h1>

<?php

foreach($topics as $topic){

?>

    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a></p>

    <p><?=$topic->getcreationDate()?></p>
    
<?php

}

?>

<h1>Créer un nouveau Sujet</h1>

<form action="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" method="POST">

<label>Titre du Sujet

    <input type="text" name="title" placeholder="Titre du sujet" required>

</label>


<label for="message">Message

    <textarea name="message"required></textarea>

</label>

<label>

    <input type="submit"  value="Créer">

</label>





</form>

