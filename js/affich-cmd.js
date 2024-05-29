const array = document.getElementById("array");

function afficheCmd() {
    fetch("affiche/", {
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
            console.log();
            array.innerHTML = "";
            if (data && data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    array.innerHTML += `<div class="card">
                        <a href="macmd/${data[i].idCommande}/">
                            <div class="card-body">
                                <h5 class="card-title">Commande n°${
                                    data[i].idCommande
                                }</h5>
                                <p class="card-text">Effectuée le ${formatDate(
                                    data[i].dateCmd
                                )} - Statut: ${
                        data[i].idStatut === 2
                            ? "Préparation"
                            : data[i].idStatut === 3
                            ? "Pris en charge"
                            : data[i].idStatut === 4
                            ? "En cours d'acheminement"
                            : data[i].idStatut === 5
                            ? "Livrée"
                            : "Annulée"
                    }</p>
                            </div>
                        </a>
                    </div>`;
                }
            } else {
                array.innerHTML =
                    "<h4 class='text-danger'>Aucune commande enregistrée</h4>";
            }
        })
        .catch((error) => {
            console.log(error);
        });
}

afficheCmd();

function formatDate(date) {
    const options = {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    };
    const formattedDate = new Date(date).toLocaleDateString(undefined, options);
    return formattedDate;
}
