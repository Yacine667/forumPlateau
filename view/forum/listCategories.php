<?php

$categories = $result["data"]['categories'];
    
?>

<h1>Liste Des Catégories</h1>

<?php

foreach($categories as $categorie){

?>
    <p><a href="index.php?ctrl=forum&action=listTopicByCat&id=<?= $categorie->getId() ?>"><?=$categorie->getNomCategorie()?></a></p>

<?php

}
