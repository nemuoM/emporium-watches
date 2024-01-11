function deleteMontre(idM) {
    fetch("del/" + idM + "/", {
        method: "GET",
    })
        .then((response) => {
            if (!response.ok) {
                console.log("Code d'état HTTP : " + response.status);
                throw new Error("La requête a échoué");
            }
            return response.json();
        })
        .then(() => afficheCart())
        .catch((error) => {
            console.error("Erreur :", error);
        });
}

function addQte(id) {
    fetch("addQte/" + id + "/", {
        method: "GET",
    })
        .then((response) => {
            if (!response.ok) {
                console.log("Code d'état HTTP : " + response.status);
                throw new Error("La requête a échoué");
            }
            return response.json();
        })
        .then(() => afficheCart())
        .catch((error) => {
            console.error("Erreur :", error);
        });
}

function decrQte(id) {
    fetch("decrQte/" + id + "/", {
        method: "GET",
    })
        .then((response) => {
            if (!response.ok) {
                console.log("Code d'état HTTP : " + response.status);
                throw new Error("La requête a échoué");
            }
            return response.json();
        })
        .then(() => afficheCart())
        .catch((error) => {
            console.error("Erreur :", error);
        });
}
