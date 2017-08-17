<form action="<?= $app->url->create('comments/edit/' . $comment->getId()) ?>" method="post">
    <input type="text" name="subject" required value="<?= htmlspecialchars($comment->getSubject()) ?>">
    <input type="text" name="author" value="<?= htmlspecialchars($comment->getAuthor())?>">
    <input type="text" name="authorEmail" required value="<?= htmlspecialchars($comment->getAuthorEmail())?>">
    <textarea name="text" cols="30" rows="10"><?= htmlspecialchars($comment->getRawText()) ?></textarea>
    <p class="text-right"><a class="button" href="<?= $app->url->create("comments") ?>">Tillbaka</a> <input class="button" type="submit" value="Ändra"></p>
</form>
