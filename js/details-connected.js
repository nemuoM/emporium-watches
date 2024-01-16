var segments = window.location.pathname.split("/");
var id = segments[segments.length - 2];
const afficher = document.getElementById("monD");

function DetailMontre(id) {
    fetch("lamontre/" + id + "/", {
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
                console.log(data);
                console.log(id);
                afficher.innerHTML = `<div class="col-md-4" width="250px">
            <img
                src="../../../../img/montre/${data[0].image}"
                class="img-montre"
                alt="${data[0].nom}"
            />
        </div>
        <div class="col-md-8">
            <div class="texto" >
                <h5>${data[0].marque}</h5>
                <h3 class="card-title mb-8">${data[0].nom}</h3>
                <p class="card-text desc">
                ${data[0].description}
                </p>
                <h4>${data[0].prix} €</h4>
                <div class="d-grid gap-2">
                    <button class="btn" type="button" onclick="addToCart(${data[0].idMontre})">
                        Ajouter  au panier
                    </button>
                </div>
            </div>
        </div>`;
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

DetailMontre(id);
