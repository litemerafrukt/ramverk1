<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $di->get('url')->asset('css/lib/normalize.css') ?>">
    <link rel="stylesheet" href="<?= $di->get('url')->asset('css/build/app.css') ?>">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
</head>
<body>

<div class="wrap-all">
    <div class="header">
        <?php if ($di->get('view')->hasContent("navbar")) : ?>
            <div class="navbar-wrap">
                <?php $di->get('view')->render("navbar") ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="content">
        <?php if ($di->get('view')->hasContent("flash")) : ?>
            <div class="flash-wrap">
                <?php $di->get('view')->render("flash") ?>
            </div>
        <?php endif ?>

        <?php if ($di->get('view')->hasContent("main")) : ?>
            <div class="main-wrap">
                <section class="section">
                    <div class="container">
                        <?php $di->get('view')->render("main") ?>
                    </div>
                </section>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <?php if ($di->get('view')->hasContent("footer")) : ?>
            <div class="footer-wrap">
                <?php $di->get('view')->render("footer") ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="<?= $di->get('url')->asset('js/build/app.js') ?>"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
</body>
</html>
