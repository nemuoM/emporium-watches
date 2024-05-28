<?php
    $title = 'Accueil';
    require_once 'header.php';

    if($_SESSION['idClient'] != 1){
        header('Location: '.SERVER_URL);
    };

?>

<link rel="stylesheet" href="<?= SERVER_URL ?>/css/back.css">
<style>
    .form-group {
        margin-top: 1rem;
    }
    label{
        font-weight: bold;
    }
</style>

<!-- Modal ajout et modification de montre -->
<div class="modal fade" id="montreModal" tabindex="-1" role="dialog" aria-labelledby="montreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="montreModalLabel">Ajouter/Modifier une montre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <form id="formMontre">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" accept="image/*">
                                <img id="imagePreview" src="" alt="Prévisualisation de l'image" style="display:none;">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom de la montre</label>
                                <input type="text" class="form-control" id="nom" placeholder="Entrez le nom de la montre">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" placeholder="Entrez la description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="marque">Marque</label>
                                <select class="form-control" id="marque">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="genre">Genre</label>
                                <select class="form-control" id="genre">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="couleur">Couleur</label>
                                <select class="form-control" id="couleur">
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="style">Style</label>
                            <select class="form-control" id="style">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mouvement">Mouvement</label>
                            <select class="form-control" id="mouvement">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="matiere-bracelet">Matière du bracelet</label>
                            <select class="form-control" id="matiereB">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="matiere-cadran">Matière du cadran</label>
                            <select class="form-control" id="matiereC">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix</label>
                            <input type="text" class="form-control" id="prix" placeholder="Entrez le prix">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" id="stock" placeholder="Entrez le stock">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="libelleModal" tabindex="-1" role="dialog" aria-labelledby="libelleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="libelleModalLabel">Ajouter un critère</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="libelle">Type d'ajout</label>
                    <select class="form-control" id="type">
                        <option>Marque</option>
                        <option>Couleur</option>
                        <option>Style</option>
                        <option>Mouvement</option>
                        <option>Matière</option>
                    </select>
                    <label for="libelle" style="margin-top: 1rem;">Libellé</label>
                    <input type="text" class="form-control" id="libelle" placeholder="Entrez le libellé">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<div class="container back">
        <div class="back-office">
            <h1>Bienvenue dans votre espace admin !</h1>
            <div class="row stats">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de montres</h5>
                            <p class="card-text" id="nbMontres"><?php echo ProductManager::getNombreMontre() ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de clients</h5>
                            <p class="card-text" id="nbClients"><?php echo ClientManager::getNbClients() ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de commandes passées</h5>
                            <p class="card-text" id="nbCmd"><?php echo CartManager::getNbCmd() ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="actions">
                <buton class="btn btn-sable" data-toggle="modal" data-target="#montreModal" onclick="resetModal()">+ Ajouter une montre</buton>
                <buton class="btn btn-sable" data-toggle="modal" data-target="#libelleModal">+ Ajouter un critère</buton>
            </div>
            <table class="table montres-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Marque</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="array">
                    
                </tbody>
            </table>
        </div>
</div>

<script src="<?= SERVER_URL ?>/js/afficher-drpBox.js"></script>
<script src="<?= SERVER_URL ?>/js/afficher-back.js"></script>

<script>
    
</script>

<?php
    require_once 'footer.php';
?>