<form action="<?= $di->get('url')->create("user/account/password") ?>" method="post">
    <p>
        <input
            class="comments-input"
            type="password"
            name="password1"
            required
            placeholder="<nytt lösenord>"
        >
    </p>
    <p>
        <input
            class="comments-input"
            type="password"
            name="password2"
            required
            placeholder="<repetera nytt lösenord>"
        >
    </p>
    <p class="text-right">
        <input class="button" type="submit" value="Ändra">
    </p>
</form>

<hr>

<a href="<?= $this->di->get('url')->create('user/account/profile') ?>">Tillbaka</a>
