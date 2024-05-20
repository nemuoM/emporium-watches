// Fonction pour effectuer une requête Fetch et mettre à jour le tableau
function AfficheWatchRecap() {
    fetch("watchrecap/", {
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
                var array = document.getElementById("array");
                let amount = 0;
                // Boucle à travers les données JSON et crée les lignes du tableau
                for (var i = 0; i < data.length; i++) {
                    array.innerHTML +=
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

function cancelCart() {
    fetch("cancel/", {
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
            window.location.href = "../../../../montres/";
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

AfficheWatchRecap();
