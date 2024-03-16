var modal = document.getElementById("errorModal");
var span = document.getElementsByClassName("close")[0];

function showError(msg) {
    document.getElementById("errorMessage").innerText = msg;
    modal.style.display = "block";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

function addToCart(id) {
    fetch("addCart/" + id + "/", {
        method: "GET",
    })
        .then((response) => {
            if (!response.ok) {
                console.log("Code d'état HTTP : " + response.status);
                throw new Error("La requête a échoué");
            }
            return response.json();
        })
        .then(showError("Ce produit a bien été ajouté à votre panier !"))
        .catch((error) => {
            console.error("Erreur :", error);
        });
}
