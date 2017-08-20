<form action="<?= $di->get('url')->create('comments/edit/' . $comment->getId()) ?>" method="post">
    <input type="text" name="subject" required value="<?= htmlspecialchars($comment->getSubject()) ?>">
    <input type="text" name="author" value="<?= htmlspecialchars($comment->getAuthor())?>">
    <input type="text" name="authorEmail" required value="<?= htmlspecialchars($comment->getAuthorEmail())?>">
    <textarea name="text" cols="30" rows="10"><?= htmlspecialchars($comment->getRawText()) ?></textarea>
    <p class="text-right"><a class="button" href="<?= $di->get('url')->create("comments") ?>">Tillbaka</a> <input class="button" type="submit" value="Ändra"></p>
</form>
