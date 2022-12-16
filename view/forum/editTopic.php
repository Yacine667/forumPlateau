
<h1>Edition du topic</h1>

<?php
$topic = $result["data"]['topic'];
$title = $topic->getTitle();
$topicId = $topic->getId();
$firstPost = $result["data"]['firstPost'];
$firstPostMessage = $firstPost->getMessage();
// var_dump($firstPost)
?>

<div>
    <form action="index.php?ctrl=forum&action=editTopic&id=<?=$topicId?>" method="post">
    <p>
            <label>
                Titre du topic :<br>
                <input type="text" name="newTitle" value="<?=$title;?>" required>
            </label>
        </p>
        <p>
            <label>
                Message :<br>
                <textarea name="newMessage" rows="5" cols="45" required><?=$firstPostMessage;?></textarea>        
            </label>
        </p>

        <div>
            <input type="submit" name="submit" value="Valider" class="submit">
        </div>
            
    </form>
</div>