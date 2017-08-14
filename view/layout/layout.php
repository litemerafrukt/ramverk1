<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $this->asset('css/lib/normalize.css') ?>">
    <link rel="stylesheet" href="<?= $this->asset('css/build/app.css') ?>">

</head>
<body>

<div class="wrap-all">
    <div class="header">
        <?php if ($this->regionHasContent("navbar")) : ?>
            <div class="navbar-wrap">
                <?php $this->renderRegion("navbar") ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="content">
        <?php if ($this->regionHasContent("main")) : ?>
            <div class="main-wrap">
                <section class="section">
                    <div class="container">
                        <?php $this->renderRegion("main") ?>
                    </div>
                </section>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <?php if ($this->regionHasContent("footer")) : ?>
            <div class="footer-wrap">
                <?php $this->renderRegion("footer") ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="<?= $this->asset('js/build/app.js') ?>"></script>
</body>
</html>
