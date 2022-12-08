<?php

use Model\Managers\PostManager;

$profils = $result["data"]['profils'];
$postManager = new PostManager();
$id = $profils->getId();

?>
<div class="topic">

    <h2>Pseudo : <?=$profils->getPseudo()?></h2>
    <p>Adresse e-mail : <?=$profils->getMail()?></p>
    <p>Role : <?= $profils->getRole()?></p>
    <p>Date d'inscription : <?=$profils->getDateInscription()?></p>
    <p>Dernier message : <?= $postManager->findLastUserPost($id)?></p>
    
</div>
<?php



?>
    
