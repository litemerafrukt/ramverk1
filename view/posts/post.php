<p>
    <a href="<?= $this->di->url->create('posts') ?>">&lt;&lt; tillbaka</a>
</p>
<h2><?= htmlspecialchars($post->subject) ?></h2>
<p class="smaller-text">Postad: <?= $post->created ?><br>
<?= !is_null($post->updated) ? "Uppdaterad: $post->updated" : "" ?></p>
<img src="<?= $post->gravatar->url() ?>" alt="<?= $post->authorEmail ?>">
<?php $viewName = $post->author ?: $post->authorEmail ?>
    <p><a href="mailto: <?= htmlspecialchars($post->authorEmail) ?>"><?= htmlspecialchars($viewName)?></a></p>
<p><?= $post->getText($formatter)?></p>
<?php if ($post->authorId == $user->id() || $user->isAdmin) : ?>
    <p class="text-right">
        <a href="<?= $di->get('url')->create('posts/edit/' . $post->id) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a href="<?= $di->get('url')->create('posts/delete/' . $post->id) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
    </p>
<?php endif ?>

<hr>

<p>&lt; comments goes here &gt;</p>
<p><?= $commentsHTML ?></p>
