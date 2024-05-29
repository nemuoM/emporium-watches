<?php
    $title = 'Espace membre';
    require_once 'header.php';
?>
<link rel="stylesheet" href="<?= SERVER_URL ?>/css/espace-ew.css" />

<div id="errorModal" class="modal">
    <div class="modal-content">
        <span class="close"></span>
        <p id="errorMessage"></p>
    </div>
</div>

<div class="formulaire">
    <img src="<?= SERVER_URL ?>/img/EW-form.png" alt="photo du formulaire" />
    <div id="form">
        <form id="connexion">
            <div class="container mignon" id="form-content">
                <div class="form-floating mb-3 formi">
                    <input
                        type="email"
                        class="form-control zoni"
                        id="floatingInput"
                        name="identifiant"
                        placeholder="name@example.com"
                    />
                    <label for="floatingInput">Adresse mail</label>
                </div>
                <div class="form-floating">
                    <input
                        type="password"
                        class="form-control zoni"
                        id="floatingPassword"
                        name="mdp"
                        placeholder="Password"
                    />
                    <label for="floatingPassword">Mot de passe</label>
                </div>
                <a id="change-form-link" class="texti" href="#">Pas encore inscrit ?</a>
                <div class="mt-auto d-flex justify-content-end">
                    <button type="submit" class="btn btn-light">Me connecter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?= SERVER_URL ?>/js/membre.js"></script>
<script>

</script>
<?php if(isset($message)) {?>
    <script>showError("<?= $message ?>");</script>
<?php
}

require_once 'footer.php';
?>
