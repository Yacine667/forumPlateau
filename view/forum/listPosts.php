<?php

$posts = $result["data"]['posts'];

    
?>

<h1>Liste Des Messages Du Sujet</h1>

<?php

foreach($posts as $post){

?>
<div class="topic">

    <p>De : <?=$post->getUser()?></p>
    <p>Le : <?=$post->getDatePost()?></p>
    <p><br></p>
    <p><?=$post->getMessage()?></p>  

    <?php

    if(\App\Session::getUser()){

                if(\App\Session::getUser()->getId() == $post->getUser()->getId() || \App\Session::isAdmin()){

?>

                    <a href="index.php?ctrl=forum&action=editPost&id=<?=$post->getId()?>">
                        <i class="fa-solid fa-pen-to-square"></i></a>


                    <a href="index.php?ctrl=forum&action=deletePost&id=<?=$post->getId()?>">
                        <i class="fa-solid fa-trash"></i></a>

<?php

                }

            }

?>
    
</div>


<?php

}

if(App\Session::getUser()){

?>

<h1>Participer : </h1>

<form action="index.php?ctrl=forum&action=addPost&id=<?=$id?>" method="POST">


<label for="message">Message</label>
<textarea name="message" required></textarea>

<input type="submit" value="Poster">





</form>
<?php
}

    else{

?>
        <p style="color: white;">Pour participer veuillez vous connecter ou vous inscrire : </p>
        <a href="index.php?ctrl=security&action=login"> Connexion </a>
        <a href="index.php?ctrl=security&action=addUser"> Inscription </a>
        
<?php
}
