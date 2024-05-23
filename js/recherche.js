function Search(value) {
    var result = document.getElementById("resultat-recherche");
    if (value && value.length >= 3) {
        var baseUrl = window.location.origin;
        var searchUrl = baseUrl + "/search/";

        fetch(searchUrl, {
            method: "POST",
            body: JSON.stringify({ search: value }),
        })
            .then((response) => {
                if (!response.ok) {
                    console.log("Code d'état HTTP : " + response.status);
                    throw new Error("La requête a échoué");
                }
                return response.json();
            })
            .then((data) => {
                if (data.length > 0) {
                    result.style.display = "block";
                    result.innerHTML = "";
                    for (var i = 0; i < data.length; i++) {
                        result.innerHTML += `<div class='col-lg-4 col-md-6'></div>
                            <div class='card'>
                            <a href='${baseUrl}/montres/detail/${data[i].idMontre}/'>
                            <div class='card-body'>
                            <h6 class='card-title'>
                            ${data[i].nom}
                            </h6>
                            </a>
                            </div>`;
                    }
                } else {
                    result.style.display = "block";
                    result.innerHTML = "";
                    result.innerHTML =
                        "<h6>Il n'y a pas de produit qui correspond à votre recherche.</h6>";
                }
            })
            .catch((error) => {
                console.error("Erreur :", error);
            });
    } else {
        result.style.display = "none";
    }
}
