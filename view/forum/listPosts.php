<?php

$posts = $result["data"]['posts'];

    
?>

<h1>Liste Des Messages Du Sujet</h1>

<?php

foreach($posts as $post){

?>
<div class="topic">

    <p><?=$post->getUser()?></p>
    <p><?=$post->getDatePost()?></p>
    <p><?=$post->getMessage()?></p>  
    
</div>
<?php

}

?>

<h1>Nouveau message</h1>

<form action="index.php?ctrl=forum&action=addPost&id=<?=$id?>" method="POST">


<label for="message">Message</label>
<textarea name="message" required></textarea>

<input type="submit" value="Poster">





</form>

