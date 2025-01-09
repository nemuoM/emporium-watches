const array = document.getElementById("array");
let ajout = false;

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
                        <td><img class="imgM" src="${data[i].image}" alt="${data[i].nom}"></td>
                        <td>${data[i].marque}</td>
                        <td>${data[i].nom}</td>
                        <td>${data[i].prix} €</td>
                        <td>${data[i].stock}</td>
                        <td>
                            <buton class="btn btn-warning" data-toggle="modal" data-target="#montreModal" onclick="rempFormMontre(${data[i].idMontre})">Modifier</buton>
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
    ajout = false;
    fetch("rempinfo/" + idM + "/", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            document.getElementById("idMontre").value = data[0].idMontre;
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

            document.getElementById("image").value = "";
            document.getElementById("imagePreview").src =
                "../../../../img/montre/" + data[0].image;
            document.getElementById("imagePreview").alt = data[0].image;
            document.getElementById("imagePreview").style.display = "block";
            document.getElementById("imagePreview").style.width = "150px";
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function resetModal() {
    ajout = true;
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
    document.getElementById("image").value = "";
    document.getElementById("imagePreview").src = "";
    document.getElementById("imagePreview").style.display = "none";
}

function addMontre() {
    let formData = new FormData();
    if (ajout) {
        var url = "ajout/";
        if (!document.getElementById("image").files[0]) {
            alert("Veuillez choisir une image");
            return;
        }
        formData.append("image", document.getElementById("image").files[0]);
    } else {
        var url = "modifMontre/";
        formData.append("id", document.getElementById("idMontre").value);
        if (document.getElementById("image").files[0]) {
            formData.append("image", document.getElementById("image").files[0]);
        } else {
            formData.append(
                "image",
                document.getElementById("imagePreview").alt
            );
        }
    }

    formData.append("nom", document.getElementById("nom").value);
    formData.append(
        "description",
        document.getElementById("description").value
    );
    formData.append("marque", document.getElementById("marque").value);
    formData.append("genre", document.getElementById("genre").value);
    formData.append("couleur", document.getElementById("couleur").value);
    formData.append("style", document.getElementById("style").value);
    formData.append("mouvement", document.getElementById("mouvement").value);
    formData.append("matiereC", document.getElementById("matiereC").value);
    formData.append("matiereB", document.getElementById("matiereB").value);
    formData.append("prix", document.getElementById("prix").value);
    formData.append("stock", document.getElementById("stock").value);

    fetch(url, {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.success);
                $("#montreModal").modal("hide");
                resetModal();
                AfficherMontre();
            } else {
                alert("Erreur lors de l'ajout de la montre");
            }
        })
        .catch((error) => {
            console.error("Erreur réseau:", error);
            alert("Erreur réseau lors de l'ajout de la montre");
        });
}

function addLibelle() {
    let formData = new FormData();
    formData.append("type", document.getElementById("type").value);
    formData.append("libelle", document.getElementById("libelle").value);

    fetch("ajoutLibelle/", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.success);
                $("#libelleModal").modal("hide");
                document.getElementById("libelle").value = "";
                lesMarques();
                lesGenres();
                lesCouleurs();
                lesStyles();
                lesMouvements();
                lesMatieres();
            } else {
                alert("Erreur lors de l'ajout du libellé");
            }
        })
        .catch((error) => {
            console.error("Erreur réseau:", error);
            alert("Erreur réseau lors de l'ajout du libellé");
        });
}
