<h1>Kommentarsprototyp</h1>
<form action="<?= $app->url->create("comments/new") ?>" method="post">
    <p>
        <input class="comments-input" type="text" name="subject" required placeholder="<rubrik>">

    </p>
    <p>
        <input class="comments-input" type="text" name="author" placeholder="<namn>">
    </p>
    <p>
        <input class="comments-input" type="text" name="authorEmail" required placeholder="<e-postadress>">
    </p>
    <p>
        <textarea class="comments-text" name="text" placeholder="<text/markdown>"></textarea>
    </p>
    <p class="text-right"><input class="button" type="submit" value="Posta"></p>
</form>
<?php foreach ($comments as $comment) : ?>
    <hr>
    <h2><?= htmlspecialchars($comment->getSubject()) ?></h2>
    <img src="<?= $comment->gravatar->url() ?>" alt="<?= $comment->getAuthorEmail() ?>">
    <?php $viewName = $comment->getAuthor() ?: $comment->getAuthorEmail() ?>
        <p><a href="mailto: <?= htmlspecialchars($comment->getAuthorEmail()) ?>"><?= htmlspecialchars($viewName)?></a></p>
    <p><?= $comment->getText($formatter)?></p>
    <p class="text-right">
        <a href="<?= $app->url->create('comments/edit/' . $comment->getId()) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a href="<?= $app->url->create('comments/delete/' . $comment->getId()) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
    </p>
<?php endforeach ?>
