const marque = document.getElementById("marque");
const genre = document.getElementById("genre");
const couleur = document.getElementById("couleur");
const style = document.getElementById("style");
const mouvement = document.getElementById("mouvement");
const matiereC = document.getElementById("matiereC");
const matiereB = document.getElementById("matiereB");

function attacherEcouteursCheckbox() {
    document.querySelectorAll(".form-check-input").forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            updateAndDisplayMontres();
        });
    });
}

function lesMarque() {
    fetch("marque/", {
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
                marque.innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    marque.innerHTML += `<div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="${data[i].idMarque}"
                        id="defaultCheck1"
                    />
                    <label class="form-check-label" for="defaultCheck1">${data[i].libelle}</label>
                </div>`;
                }
                attacherEcouteursCheckbox();
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
function lesGenres() {
    fetch("genre/", {
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
                genre.innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    genre.innerHTML += `<div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="${data[i].idGenre}"
                        id="defaultCheck1"
                    />
                    <label class="form-check-label" for="defaultCheck1">${data[i].libelle}</label>
                </div>`;
                }
                attacherEcouteursCheckbox();
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
function lesCouleurs() {
    fetch("couleur/", {
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
                couleur.innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    couleur.innerHTML += `<div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="${data[i].idCouleur}"
                        id="defaultCheck1"
                    />
                    <label class="form-check-label" for="defaultCheck1">${data[i].libelle}</label>
                </div>`;
                }
                attacherEcouteursCheckbox();
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
function lesStyles() {
    fetch("style/", {
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
                style.innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    style.innerHTML += `<div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="${data[i].idStyle}"
                        id="defaultCheck1"
                    />
                    <label class="form-check-label" for="defaultCheck1">${data[i].libelle}</label>
                </div>`;
                }
                attacherEcouteursCheckbox();
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
function lesMouvements() {
    fetch("mouvement/", {
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
                mouvement.innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    mouvement.innerHTML += `<div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="${data[i].idMouvement}"
                        id="defaultCheck1"
                    />
                    <label class="form-check-label" for="defaultCheck1">${data[i].libelle}</label>
                </div>`;
                }
                attacherEcouteursCheckbox();
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
function lesMatieres() {
    fetch("matiere/", {
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
                matiereC.innerHTML = "";
                matiereB.innerHTML = "";
                for (var i = 0; i < data.length; i++) {
                    matiereC.innerHTML += `<div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="${data[i].idMatiere}"
                        id="defaultCheck1"
                    />
                    <label class="form-check-label" for="defaultCheck1">${data[i].libelle}</label>
                </div>`;
                    matiereB.innerHTML += `<div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        value="${data[i].idMatiere}"
                        id="defaultCheck1"
                    />
                    <label class="form-check-label" for="defaultCheck1">${data[i].libelle}</label>
                </div>`;
                }
                attacherEcouteursCheckbox();
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

lesMarque();
lesGenres();
lesCouleurs();
lesStyles();
lesMouvements();
lesMatieres();
