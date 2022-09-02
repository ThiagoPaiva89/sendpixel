<?php
session_start();
include './../app/Conf.php';
include './../app/autoload.php';
?>
<!doctype html>
<html lang="pt-br">

<head>

    <link rel="shortcut icon" type="image/x-icon" href="<?= Url ?>/img/favicon.ico">
    <title> SENDPIXEL - Tecnologias Web </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Thiago Paiva">
    <meta name="description" content="Sua empresa em destaque na web">
    <meta name="keywords" content="Marketing, tecnologia">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="<?= Url ?>/style/normalize.css">
    <link rel="stylesheet" href="<?= Url ?>/style/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

</head>

<body class="no-js">
    <?php
    include '../app/Views/header.php';
    $rotas = new Rota();
    include '../app/Views/footer.php';

    ?>
    <script src="<?= Url ?>/public/js/carousel.js"></script>
    <script src="<?= Url ?>/public/js/menu.js"></script>
    <script src="<?= Url ?>/public/js/main.js"></script>
    <script src="<?= Url ?>/public/js/funcoes.jquery.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>




</body>

</html>