const afficher = document.getElementById("mesProd");

function AfficherMontre(filtres) {
    fetch("affiche/", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(filtres),
    })
        .then((response) => {
            if (!response.ok) {
                console.log("Code d'état HTTP : " + response.status);
                throw new Error("La requête a échoué");
            }
            return response.json();
        })
        .then((data) => {
            afficher.innerHTML = "";
            if (data && data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    afficher.innerHTML += `<div class="card pdt">
                            <a
                                class="texti"
                                href="detail/${data[i].idMontre}/"
                                >
                                <img
                                src="${data[i].image}"
                                class="card-img-top"
                                alt="${data[i].nom}"
                                />
                                <div class="card-body texti">
                                <h6 class="card-text">${data[i].marque}</h6>
                                <h5 class="card-title">${data[i].nom}</h5>
                                <div class="minini">
                                <p class="card-text">${data[i].prix} €</p>
                                <a class="fin btn ${
                                    data[i].stock === 0
                                        ? 'btn-rouge" disabled'
                                        : `btn-sable" onclick="addToCart(${data[i].idMontre})`
                                }">${
                        data[i].stock === 0
                            ? "Rupture de stock"
                            : `Ajouter au panier`
                    }</a>
                                </a>
                                </div>
                                </div>
                                </a>
                                </div>`;
                }
            } else {
                afficher.innerHTML += `<h1 class="rien">Aucun produit correspondant.</h1>`;
                console.error(
                    "La requête ne comporte aucun éléments à afficher."
                );
            }
        })
        .catch((error) => {
            console.error("Erreur :", error);
        });
}

function getCheckedValues(filterElement) {
    var checkedValues = [];
    var checkboxes = filterElement.querySelectorAll(
        'input[type="checkbox"]:checked'
    );
    checkboxes.forEach((checkbox) => {
        checkedValues.push(checkbox.value);
    });

    return checkedValues;
}

function updateAndDisplayMontres() {
    let filtres = {
        marque: getCheckedValues(marque),
        genre: getCheckedValues(genre),
        couleur: getCheckedValues(couleur),
        style: getCheckedValues(style),
        mouvement: getCheckedValues(mouvement),
        matiereC: getCheckedValues(matiereC),
        matiereB: getCheckedValues(matiereB),
    };

    AfficherMontre(filtres);
}

AfficherMontre();
