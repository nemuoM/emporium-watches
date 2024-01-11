<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="shortcut icon" href="<?= SERVER_URL ?>/img/logo-sablier.png"/>
        <link rel="stylesheet" href="<?= SERVER_URL ?>/css/style-base.css" />
        <?php if($title === 'Informations'){ ?>
            <link rel="stylesheet" href="<?= SERVER_URL ?>/css/spe.css">
        <?php } ?>
        <title>EW | <?= $title ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <div class="divbar mars">
        <form class="d-flex espace" role="search">
        <input class="form-control me-2 rech" type="search" placeholder="Search" aria-label="Search">
        <button class=" gnonmi pioupiou" type="submit">Rechercher</button>
      </form>
        <div id="text">
            <li class="ha"><a href="<?= SERVER_URL ?>/">Accueil</a></li>
            <li class="he"><a href="<?= SERVER_URL ?>/montres/">Nos montres & accessoires</a></li>
            <li class="ho"><a href="<?= SERVER_URL ?>/info/">Informations</a></li>
        </div>

        <a href="<?= SERVER_URL ?>/panier/"><img class="panier"src="<?= SERVER_URL ?>/img/118089.png" alt="logo-panier"></a>
        <div id="espace-membre">
            <ul>
                <?php if(isset($_SESSION['idClient'])) {?>
                    <li><a href="<?= SERVER_URL ?>/profil/">Espace Membre
                    <img src="<?= SERVER_URL ?>/img/logo_client.png" alt="logo-espace-membre" /></a></li>
                <?php } else {?>
                    <li><a href="<?= SERVER_URL ?>/espace-membre/">Espace Membre
                    <img src="<?= SERVER_URL ?>/img/logo_client.png" alt="logo-espace-membre" /></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</html>
