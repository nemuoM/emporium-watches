// Récupérer l'id dans l'URL
const url = window.location.href;
var id = url.substring(url.lastIndexOf("/") - 1);
id = id.slice(0, -1);

AfficheWatchRecap(id);

// Fonction pour effectuer une requête Fetch et mettre à jour le tableau
function AfficheWatchRecap(id) {
    fetch("cmdrecap/" + id + "/", {
        method: "GET",
    })
        .then((response) => {
            if (!response.ok) {
                console.log("Code d'état HTTP : " + response.status);
                throw new Error("La requête a échoué");
            }
            return response.json();
        })
        .then((data) => {
            if (data && data.length > 0) {
                var btn = document.getElementById("mesActions");
                var array = document.getElementById("array");
                var annule = document.getElementById("annuleM");
                annule.innerHTML = `<button type="button" onclick="cancelCart(${id})" class="btn btn-success">Oui</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>`;
                let amount = 0;
                if (data[0].idStatut == 2) {
                    btn.innerHTML = `<button onclick="showConfirmationModal()" class="btn btn-danger">Annuler la commande</button>
                <buton onclick="backToShopping()" class="btn btn-sable">Retour au shopping</buton>`;
                } else {
                    btn.innerHTML = `<button onclick="backToShopping()" class="btn btn-sable">Retour au shopping</buton>`;
                }
                // Boucle à travers les données JSON et crée les lignes du tableau
                for (var i = 0; i < data.length; i++) {
                    array.innerHTML +=
                        "<td><img class='imgM' src='" +
                        data[i].image +
                        "'></td>" +
                        "<td>" +
                        data[i].nom +
                        "</td>" +
                        "<td>" +
                        data[i].marque +
                        "</td>" +
                        "<td>" +
                        data[i].prix +
                        " €</td>" +
                        "<td>" +
                        data[i].qte +
                        "</td>" +
                        "<td>" +
                        data[i].prix * data[i].qte +
                        " €</td>";
                    amount += data[i].prix * data[i].qte;
                }
                total.innerHTML = amount + " €";
            } else {
                console.error(
                    "La requête ne comporte aucun éléments à afficher."
                );
            }
        })
        .catch((error) => {
            console.error("Erreur :", error);
        });
}

function cancelCart(id) {
    fetch("cancel/" + id + "/", {
        method: "GET",
    })
        .then((response) => {
            if (!response.ok) {
                console.log("Code d'état HTTP : " + response.status);
                throw new Error("La requête a échoué");
            }
            return response.json();
        })
        .then(() => {
            window.location.href = "../../../../profil/";
        })
        .catch((error) => {
            console.error("Erreur :", error);
        });
}

function showConfirmationModal() {
    $("#confirmationModal").modal("show");
}

function backToShopping() {
    window.location.href = "../../../../";
}
