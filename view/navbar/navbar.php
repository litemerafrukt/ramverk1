<nav class="navbar">
    <a class="navbar-brand" href="<?= $di->get('navbar')->navbarBrand()['route'] ?>"><?= $di->get('navbar')->navbarBrand()['label'] ?></a>

    <div class="desktop">
        <?php foreach ($di->get('navbar')->navroutes() as $navroute) : ?>
            <a
                    href="<?= $navroute['route'] ?>"
                    class="<?= $navroute['route'] == $di->get('request')->getCurrentUrl() ? 'active' : '' ?>"
            ><?= $navroute['label'] ?></a>
        <?php endforeach; ?>
        <a class="left-divider login-button" href="<?= $di->get('url')->create('user/login') ?>"><?= $di->get('loginButton')->icon() ?></a>
    </div>

    <div class="tablet">
        <a id="hamburger-menu-open" href="#"><i class="fa fa-bars fa-large"></i></a>
        <div id="hamburger-menu" class="hamburger-menu hidden">
            <div class="hamburger-menu-top">
                <div class="hamburger-menu-top-wrap">
                    <div class="empty"></div>
                    <a id="hamburger-menu-close" href="#"><i class="fa fa-times fa-large"></i></a>
                </div>
            </div>
            <div class="hamburger-menu-links-wrap">
                <?php foreach ($di->get('navbar')->navroutes() as $navroute) : ?>
                    <a
                            href="<?= $navroute['route'] ?>"
                            class="<?= $navroute['route'] == $di->get('request')->getCurrentUrl() ? 'active' : '' ?>"
                    ><?= $navroute['label'] ?></a>
                <?php endforeach; ?>
                <a class="login-button" href="<?= $di->get('url')->create('user/login') ?>"><?= $di->get('loginButton')->icon() ?></a>
            </div>
        </div>
    </div>
</nav>
