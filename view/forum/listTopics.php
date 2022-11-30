<?php

$topics = $result["data"]['topics'];
    
?>

<h1>Liste Des Sujets</h1>

<?php

foreach($topics as $topic){

?>

    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a></p>

    <p><?=$topic->getcreationDate()?></p>
    
<?php

}

?>

<h1>Créer un nouveau Sujet</h1>

<form action="" method="POST">

<label for="action">Titre du Sujet</label>
<input type="text" name="title" required>

<label for="message">Message</label>
<textarea name="message" id="messageInput" required></textarea>

<button type="submit" >Créer</button>





</form>


  
