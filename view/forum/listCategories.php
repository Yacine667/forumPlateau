<?php

$categories = $result["data"]['categories'];
    
?>

<h1>Liste Des Catégories</h1>

<?php

foreach($categories as $categorie){

?>
<div onclick="document.location='index.php?ctrl=forum&action=listTopicByCat&id=<?= $categorie->getId() ?>'" class="topic">

    <h2><a href="index.php?ctrl=forum&action=listTopicByCat&id=<?= $categorie->getId() ?>"><?=$categorie->getNomCategorie()?></a></h2>
    <?php

    if(App\Session::isAdmin()){
?>

        <a href="index.php?ctrl=forum&action=editCategorie&id=<?=$categorie->getId()?>"><i class="fa-solid fa-pen-to-square"></i></a>

        <a href="index.php?ctrl=forum&action=deleteCategorie&id=<?=$categorie->getId()?>"><i class="fa-solid fa-trash"></i></a>
  
<?php

}

?>

</div>

<?php

}

if(App\Session::isAdmin()){
?>
   <div>

    <h1>Création d'une catégorie</h1>

    <form action="index.php?ctrl=forum&action=addCategorie" method="post">
        
        <input type="text" name="nomCategorie" placeholder="Entrez le nom de la catégorie" required>
        <input type="submit" value="Créer">

    </form>

</div>
  
<?php

}
