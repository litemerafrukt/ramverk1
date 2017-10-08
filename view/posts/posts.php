<h1>Forumprototyp</h1>
<?php if ($user->isUser) : ?>
    <form action="<?= $di->get('url')->create("posts/new") ?>" method="post">
        <p>
            <input class="comments-input" type="text" name="subject" required placeholder="<rubrik>">
        </p>
        <p>
            <textarea class="comments-text" name="text" placeholder="<text/markdown>"></textarea>
        </p>
        <p class="text-right"><input class="button" type="submit" value="Posta"></p>
    </form>
<?php else : ?>
    <p>
        <a href="<?= $this->di->get('url')->create('user/login') ?>">Logga in</a> för att posta ett inlägg.
    </p>
<?php endif ?>

<?php foreach ($posts as $post) : ?>
    <hr>
    <p>
        <a href="<?= $this->di->get('url')->create('posts/show/'.$post->id) ?>">
            <span class="larger-text"><?= htmlspecialchars($post->subject) ?></span>
        </a>
        <br>
        <span class="smaller-text">
            av <?= $post->author ?: $post->authorEmail ?>
            @ <?= $post->created ?><?= !is_null($post->updated) ? "& $post->updated" : "" ?>
        </span>
    </p>
<?php endforeach ?>
