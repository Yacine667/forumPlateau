<?php

$profils = $result["data"]['profils'];





?>
<div class="topic">

    <h2><?=$profils->getPseudo()?></h2>
    <p><?=$profils->getMail()?></p>
    <p><br></p>
    <p><?=$profils->getDateInscription()?></p>
    <p></p>  
    
</div>
<?php



?>
    
