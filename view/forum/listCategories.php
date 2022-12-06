<?php

$categories = $result["data"]['categories'];
    
?>

<h1>Liste Des Catégories</h1>

<?php

foreach($categories as $categorie){

?>
<div onclick="document.location='index.php?ctrl=forum&action=listTopicByCat&id=<?= $categorie->getId() ?>'" class="topic">

    <p><a href="index.php?ctrl=forum&action=listTopicByCat&id=<?= $categorie->getId() ?>"><?=$categorie->getNomCategorie()?></a></p>

</div>
<?php

}
