<img src="<?= $user->gravatar->url() ?>" alt="ingen gravatar">
<p><strong>Användarnamn:</strong> <?= $user->name() ?></p>
<p><strong>E-postadress:</strong> <?= $user->email() ?> </p>

<hr>

<?php if ($user->isAdmin) : ?>
    <p><a href="<?= $this->di->get('url')->create('admin/index') ?>"><strong>Admin</strong></a></p>
<?php endif ?>

<p>
    <a
        class="text-right"
        href="<?= $this->di->get('url')->create('user/account/profile/edit/') ?>"
    >Ändra profil</a>
</p>
<p>
    <a
        class="text-right"
        href="<?= $this->di->get('url')->create('user/logout') ?>"
    >Logga ut</a>
</p>
