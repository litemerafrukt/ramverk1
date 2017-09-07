<form action="<?= $di->get('url')->create("user/account/profile/edit/") ?>" method="post">
    <p>
        <input
            class="comments-input"
            type="text"
            name="username"
            required
            placeholder="<användarnamn>"
            value="<?= $user->name() ?>"
        >
    </p>
    <p>
        <input
            class="comments-input"
            type="text"
            name="email"
            required
            placeholder="<e-postadress>"
            value="<?= $user->email() ?>"
        >
    </p>
    <p>
        <a href="<?= $this->di->get('url')->create('user/account/password') ?>">Ändra lösenord</a>
    </p>
    <p class="text-right">
        <input class="button" type="submit" value="Ändra">
    </p>
</form>

<hr>

<a href="<?= $this->di->get('url')->create('user/account/profile') ?>">Tillbaka</a>
