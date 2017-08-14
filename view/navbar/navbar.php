<nav class="navbar">
    <a class="navbar-brand" href="<?= $app->navbar->navbarBrand()['route'] ?>"><?= $app->navbar->navbarBrand()['label'] ?></a>

    <div class="desktop">
        <?php foreach ($app->navbar->navroutes() as $navroute) : ?>
            <a
                    href="<?= $navroute['route'] ?>"
                    class="<?= $navroute['route'] == $app->request->getCurrentUrl() ? 'active' : '' ?>"
            ><?= $navroute['label'] ?></a>
        <?php endforeach; ?>
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
                <?php foreach ($app->navbar->navroutes() as $navroute) : ?>
                    <a
                            href="<?= $navroute['route'] ?>"
                            class="<?= $navroute['route'] == $app->request->getCurrentUrl() ? 'active' : '' ?>"
                    ><?= $navroute['label'] ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</nav>
