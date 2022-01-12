<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?=$title?></title>
    <link rel="stylesheet" href="../../build/css/style.css">
    <script src="https://kit.fontawesome.com/351e9300a0.js" crossorigin="anonymous"></script>
    <script src="../../build/js/front.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<header>
    <nav class="#0d47a1 blue darken-4">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">TABLEAU DE BORD</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="../../">Utilisateurs</a></li>
                <li><a href="../../?controller=article&action=view">Articles</a></li>
            </ul>
        </div>
    </nav>
</header>

<?=$html?>

</body>
</html>