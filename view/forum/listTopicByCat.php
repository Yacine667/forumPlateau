<?php

$topics = (!$result["data"]['topics']) ? [] : $result["data"]['topics'];

    
?>

<h1>Liste Des Sujets De La Catégorie </h1>

<?php

foreach($topics as $topic){

?>

<div class="topic"  onclick="document.location='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'" >

    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a></p>

    <p>Créé par : <?=$topic->getUser()?></p>
    <p> Le : <?=$topic->getcreationDate()?></p>

    <?php

        if(App\Session::getUser()){

            if(App\Session::isAdmin() || App\Session::getUser()->getId() == $topic->getUser()->getId()){

                if($topic->getClosed() == 0){ ?>

                   <a href="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId()?>"><i class="fa-solid fa-lock"></i></a> 
                <?php

                } 
                    
                    else { 

                        ?> 

                        <a href="index.php?ctrl=forum&action=unlockTopic&id=<?=$topic->getId()?>"><i class="fa-solid fa-unlock"></i></a> 

                        <?php
                        
                    }
?>

                <a href="index.php?ctrl=forum&action=editTopicForm&id=<?=$topic->getId()?>">
                <i class="fa-solid fa-pen-to-square"></i>
                </a>

                <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId()?>">
                    <i class="fa-solid fa-trash"></i>
                </a>

<?php

                }
    
            }  

?>
              

</div>
 
<?php

}


if(App\Session::getUser()){
?>

<h1>Créer un nouveau Sujet</h1>

<form action="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" method="POST">

<label>Titre du Sujet <br>

    <input class="ajout" type="text" name="title" placeholder="              Titre du sujet" required>

</label>


<label for="message">Message <br>

    <textarea class="ajout" name="message"required></textarea>

</label>

<label>

    <input type="submit"  value="Créer">

</label>

</form>
<?php
}
    else{
?>
        <p style="color: white;">Pour créer un sujet veuillez vous connecter ou vous inscrire : </p>
        <a href="index.php?ctrl=security&action=login"> Connexion </a>
        <a href="index.php?ctrl=security&action=addUser"> Inscription </a>
    
<?php

}
