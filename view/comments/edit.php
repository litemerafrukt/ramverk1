<form action="<?= $di->get('url')->create('comments/edit/' . $comment->getId()) ?>" method="post">
    <p>
        <input
            class="comments-input"
            type="text" name="subject"
            required
            value="<?= htmlspecialchars($comment->getSubject()) ?>"
        >
    </p>
    <p>
        <textarea
            class="comments-text"
            name="text"
            ><?= htmlspecialchars($comment->getRawText()) ?></textarea>
    </p>
    <p class="text-right"><a class="button" href="<?= $di->get('url')->create("comments") ?>">Tillbaka</a> <input class="button" type="submit" value="Ändra"></p>
</form>
