const array = document.getElementById("array");

function AfficherMontre() {
    fetch("affiche/", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => {
            if (!response.ok) {
                console.log("Code d'état HTTP : " + response.status);
                throw new Error("La requête a échoué");
            }
            return response.json();
        })
        .then((data) => {
            array.innerHTML = "";
            if (data && data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    array.innerHTML += `<tr>
                        <td><img class="imgM" src="../../../../img/montre/${data[i].image}" alt="${data[i].nom}"></td>
                        <td>${data[i].marque}</td>
                        <td>${data[i].nom}</td>
                        <td>${data[i].prix} €</td>
                        <td>${data[i].stock}</td>
                        <td>
                            <buton class="btn btn-warning" data-toggle="modal" data-target="#montreModal" onclick="rempFormMontre(${data[i].idMontre})">Modifier</buton>
                            <a class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>`;
                }
            }
        })
        .catch((error) => {
            console.error("Erreur :", error);
        });
}

AfficherMontre();

function rempFormMontre(idM) {
    fetch("rempinfo/" + idM + "/", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            document.getElementById("nom").value = data[0].nom;
            document.getElementById("description").value = data[0].description;
            document.getElementById("marque").value = data[0].idMarque;
            document.getElementById("genre").value = data[0].idGenre;
            document.getElementById("couleur").value = data[0].idCouleur;
            document.getElementById("style").value = data[0].idStyle;
            document.getElementById("mouvement").value = data[0].idMouvement;
            document.getElementById("matiereB").value =
                data[0].idMatiereBracelet;
            document.getElementById("matiereC").value = data[0].idMatiereCadran;
            document.getElementById("prix").value = data[0].prix;
            document.getElementById("stock").value = data[0].stock;

            document.getElementById("imagePreview").src =
                "../../../../img/montre/" + data[0].image;
            document.getElementById("imagePreview").style.display = "block";
            document.getElementById("imagePreview").style.width = "150px";
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function resetModal() {
    document.getElementById("nom").value = "";
    document.getElementById("description").value = "";
    document.getElementById("marque").value = "";
    document.getElementById("genre").value = "";
    document.getElementById("couleur").value = "";
    document.getElementById("style").value = "";
    document.getElementById("mouvement").value = "";
    document.getElementById("matiereB").value = "";
    document.getElementById("matiereC").value = "";
    document.getElementById("prix").value = "";
    document.getElementById("stock").value = "";

    document.getElementById("imagePreview").src = "";
    document.getElementById("imagePreview").style.display = "none";
}
