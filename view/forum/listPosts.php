<?php

$posts = $result["data"]['posts'];
    
?>

<h1>Liste Des Messages Du Sujet</h1>

<?php

foreach($posts as $post){

?>

    <p><?=$post->getMessage()?></p>

    <p><?=$post->getDatePost()?></p>

<?php

}

?>

<h1>Nouveau message</h1>

<form action="" method="POST">


<label for="message">Message</label>
<textarea name="message" id="messageInput" required></textarea>

<button type="submit" >Répondre</button>





</form>

