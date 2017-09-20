<h1>Kommentarsprototyp</h1>
<?php if ($user->isUser) : ?>
    <form action="<?= $di->get('url')->create("comments/new") ?>" method="post">
        <p>
            <input class="comments-input" type="text" name="subject" required placeholder="<rubrik>">
        </p>
        <!-- <p>
            <input class="comments-input" type="text" name="author" placeholder="<namn>">
        </p>
        <p>
            <input class="comments-input" type="text" name="authorEmail" required placeholder="<e-postadress>">
        </p> -->
        <p>
            <textarea class="comments-text" name="text" placeholder="<text/markdown>"></textarea>
        </p>
        <p class="text-right"><input class="button" type="submit" value="Posta"></p>
    </form>
<?php else : ?>
    <p>
        <a href="<?= $this->di->get('url')->create('user/login') ?>">Logga in</a> för att lämna en kommentar.
    </p>
<?php endif ?>

<?php foreach ($comments as $comment) : ?>
    <hr>
    <h2><?= htmlspecialchars($comment->subject) ?></h2>
    <img src="<?= $comment->gravatar->url() ?>" alt="<?= $comment->authorEmail ?>">
    <?php $viewName = $comment->author ?: $comment->authorEmail ?>
        <p><a href="mailto: <?= htmlspecialchars($comment->authorEmail) ?>"><?= htmlspecialchars($viewName)?></a></p>
    <p><?= $comment->getText($formatter)?></p>
    <?php if ($comment->authorId == $user->id() || $user->isAdmin) : ?>
        <p class="text-right">
            <a href="<?= $di->get('url')->create('comments/edit/' . $comment->id) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <a href="<?= $di->get('url')->create('comments/delete/' . $comment->id) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
        </p>
    <?php endif ?>
<?php endforeach ?>
