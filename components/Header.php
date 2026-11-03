<?php
    $basePath = $basePath ?? "./";
    $navLinks = $navLinks ?? [];
    $extraCss = $extraCss ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Sistemas Documentos UMES' ?></title>
    
    <link rel="stylesheet" href="<?= $basePath ?>css/style.css">
    <link rel="stylesheet" href="<?= $basePath ?>css/components.css">
    
    <?php foreach ($extraCss as $css): ?>
        <link rel="stylesheet" href="<?= $css ?>">
    <?php endforeach; ?>

    <link rel="icon" href="<?= $basePath ?>images/<?= $logo ?? 'logoNexus.png' ?>" type="image/x-icon">
</head>
<body>
    <header>
        <section class="logoSection">
            <a href="<?= $basePath ?>index.php"><img src="<?= $basePath ?>images/logoNexus.png" class="imageLogo"></a>
        </section>
        <section class="navbarOptions">
            <?php foreach ($navLinks as $link): ?>
                <a href="<?= $basePath ?><?= $link['url'] ?>" class="navButton"><strong><?= $link['title'] ?></strong></a>
            <?php endforeach; ?>
        </section>
    </header>