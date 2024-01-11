const afficher = document.getElementById("monCart");
const recap = document.getElementById("total-amount");

var servurl = "<?= SERVER_URL ?>";
var plus = "<?= SERVER_URL ?>/img/plus.svg";
var moins =
    "<?= SERVER_URL ?>/img/minus-sign-of-a-line-in-horizontal-position-svgrepo-com.svg";

function afficheCart() {
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
            afficher.innerHTML = "";
            var montant = 0;
            recap.innerHTML = "";
            if (data && data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    afficher.innerHTML += `<div class="card">
                            <button class="cross-button" onclick="deleteMontre(${data[i].idMontre})">
                                <img
                                    src="../../../../img/cross-svgrepo-com.svg"
                                    class="cross-icon"
                                    alt="Croix"
                                />
                            </button>
                            <div class="row g-0">
                                <div class="col-md-4 cartimg">
                                    <img
                                        src="${data[i].image}"
                                        class="img-fluid rounded-start cartimg"
                                        alt="..."
                                    />
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5>${data[i].marque}</h5>
                                        <h3 class="card-title">
                                            ${data[i].nom}
                                        </h3>
                                        <h6>${data[i].prix} €</h6>
                                        <div class="quantity-selector">
                                            <div class="quantity-buttons">
                                                <button
                                                    id="decrement"
                                                    class="quantity-btn decrement-btn"
                                                    onclick="decrQte(${data[i].idMontre})"
                                                >
                                                    <img
                                                        class="moins"
                                                        src="../../../../img/minus-sign-of-a-line-in-horizontal-position-svgrepo-com.svg"
                                                        alt=""
                                                    />
                                                </button>
                                                <span
                                                    id="quantity"
                                                    class="quantity-display"
                                                >
                                                    ${data[i].qte}
                                                </span>
                                                <button
                                                    id="increment"
                                                    class="quantity-btn increment-btn"
                                                    onclick="addQte(${data[i].idMontre})"
                                                >
                                                    <img
                                                        class="moins"
                                                        src="../../../../img/plus.svg"
                                                        alt=""
                                                    />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    montant += data[i].prix * data[i].qte;
                }
                recap.innerHTML += `Le montant de votre panier est de: ${montant} €`;
            } else {
                afficher.innerHTML += `<h1 class="rien"> Votre panier est vide .</h1>`;
                document
                    .getElementById("validate-cart")
                    .setAttribute("disabled", "");
                recap.innerHTML += `Le montant de votre panier est de: ${montant} €`;
            }
        })
        .catch((error) => {
            console.error("Erreur :", error);
        });
}

afficheCart();
