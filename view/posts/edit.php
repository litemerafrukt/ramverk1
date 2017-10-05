<form action="<?= $di->get('url')->create('posts/edit/' . $post->id) ?>" method="post">
    <p>
        <input
            class="comments-input"
            type="text" name="subject"
            required
            value="<?= htmlspecialchars($post->subject) ?>"
        >
    </p>
    <p>
        <textarea
            class="comments-text"
            name="text"
            ><?= htmlspecialchars($post->rawText) ?></textarea>
    </p>
    <p class="text-right"><a class="button" href="<?= $di->get('url')->create("posts") ?>">Tillbaka</a> <input class="button" type="submit" value="Ändra"></p>
</form>
