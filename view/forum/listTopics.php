<?php

$topics = (!$result["data"]['topics']) ? [] : $result["data"]['topics'];

    
?>

<h1>Liste Des Sujets</h1>

<?php

foreach($topics as $topic){

?>
<div class="topic" onclick="document.location='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'">

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

?>




  
