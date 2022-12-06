<?php

$users = $result["data"]['users'];

    
?>

<h1>Liste Des Utilisateurs Inscrits</h1>

<?php

foreach($users as $user){

?>
<div class="topic" onclick="document.location='index.php?ctrl=home&action=viewprofils&id=<?= $user->getId() ?>'">

    <p>Pseudo : <?= $user->getPseudo() ?></p>
    <p>Adresse e-mail : <?=$user->getMail()?></p>
    <p>Date d'inscription : <?=$user->getDateInscription()?></p>

    

</div>   
<?php

}

?>

