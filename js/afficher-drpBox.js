const marque = document.getElementById("marque");
const genre = document.getElementById("genre");
const couleur = document.getElementById("couleur");
const style = document.getElementById("style");
const mouvement = document.getElementById("mouvement");
const matiereC = document.getElementById("matiereC");
const matiereB = document.getElementById("matiereB");

function lesMarques() {
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
                    marque.innerHTML += `<option value="${data[i].idMarque}">${data[i].libelle}</option>`;
                }
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
                    genre.innerHTML += `<option value="${data[i].idGenre}">${data[i].libelle}</option>`;
                }
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
                    couleur.innerHTML += `<option value="${data[i].idCouleur}">${data[i].libelle}</option>`;
                }
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
                    style.innerHTML += `<option value="${data[i].idStyle}">${data[i].libelle}</option>`;
                }
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
                    mouvement.innerHTML += `<option value="${data[i].idMouvement}">${data[i].libelle}</option>`;
                }
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
                    matiereC.innerHTML += `<option value="${data[i].idMatiere}">${data[i].libelle}</option>`;
                    matiereB.innerHTML += `<option value="${data[i].idMatiere}">${data[i].libelle}</option>`;
                }
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

lesMarques();
lesGenres();
lesCouleurs();
lesStyles();
lesMouvements();
lesMatieres();

lesMarques();
