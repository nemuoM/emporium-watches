<!DOCTYPE html>
<html lang="fr">
    <body>
        <footer class="bg-dark text-center text-lg-start text-white pluton" <?php if($title === 'Informations') {echo 'style="margin-top = 20px"';}?>>
            <div class="container p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Emporium Watches</h5>
                        <p>
                            Chez Emporium Watches, nous vous offrons les
                            meilleures montres de qualité. Visitez notre magasin
                            pour découvrir notre collection unique.
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Liens</h5>
                        <ul class="list-unstyled mb-0">
                            <li><a href="<?= SERVER_URL ?>/" class="text-white">Accueil</a></li>
            <li><a href="<?= SERVER_URL ?>/montres/" class="text-white">Nos Montres</a></li>
            <li><a href="<?= SERVER_URL ?>/info/" class="text-white">Informations</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Contact</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#!" class="text-white"
                                    >+33 4 23 45 67 89</a
                                >
                            </li>
                            <li>
                                <a href="#!" class="text-white"
                                    >info@emporiumwatches.com</a
                                >
                            </li>
                            <li>
                                <a href="#!" class="text-white"
                                    >Montpellier, France</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div
                class="text-center p-3"
                style="background-color: rgba(0, 0, 0, 0.2)"
            >
                © 2023 Emporium Watches
            </div>
        </footer>
    </body>
    <script src="<?= SERVER_URL ?>/js/addToCart.js"></script>
</html>
