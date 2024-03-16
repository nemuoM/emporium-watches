document.addEventListener("DOMContentLoaded", function () {
    var formContent = document.getElementById("form");

    function toggleForm(event) {
        event.preventDefault();
        if (changeFormLink.textContent.includes("Pas encore inscrit")) {
            formContent.innerHTML = `
                <!-- Contenu du formulaire d'inscription -->
                <form method="post" action="inscription/" class="form">
                <div class="container mignon" id="form-content">
                <fieldset class="row mb-3">
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="genre"
                                id="inlineRadio1"
                                value="1"
                            />
                            <label
                                class="form-check-label popo"
                                for="inlineRadio1"
                                >Monsieur</label
                            >
                        </div>
                        <div class="form-check form-check-inline ms-5 m-3">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="genre"
                                id="inlineRadio2"
                                value="2"
                            />
                            <label
                                class="form-check-label popo"
                                for="inlineRadio2"
                                >Madame</label
                            >
                        </div>
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col form-floating border-ew">
                        <input
                            type="text"
                            class="form-control zoni"
                            id="floatingName"
                            name="nom"
                            placeholder="Nom"
                        />
                        <label for="floatingName" class="inputi">Nom</label>
                    </div>
                    <div class="col form-floating ms-5">
                        <input
                            type="text"
                            class="form-control zoni"
                            id="floatingName"
                            name="prenom"
                            placeholder="Prénom"
                        />
                        <label for="floatingName" class="inputi">Prénom</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 form-floating">
                        <input
                            type="email"
                            class="form-control zoni"
                            id="floatingEmail"
                            name="mail"
                            placeholder="name@example.com"
                        />
                        <label for="floatingEmail" class="inputi"
                            >Adresse mail</label
                        >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 mb-2 form-floating">
                        <input
                            type="password"
                            class="form-control zoni"
                            id="floatingPassword"
                            name="lemdp"
                            placeholder="Password"
                        />
                        <label for="floatingPassword" class="inputi"
                            >Mot de passe</label
                        >
                    </div>
                    <div class="indic">
                        <p class="fs-6 popod">• 8 caractères ou +</p>
                        <p class="fs-6 popod">• 1 majucule ou +</p>
                        <p class="fs-6 popod">• 1 chiffre ou +</p>
                        <p class="fs-6 popod">
                            • 1 caractère spécial (@,!,?,...)
                        </p>
                        <p class="fs-6 popod">
                            • Ne doit pas contenir votre nom ou votre prénom
                        </p>
                    </div>

                    <div class="col-sm-10 mb-2 form-floating">
                        <input
                            type="password"
                            class="form-control zoni"
                            id="floatingPassword"
                            name="confirm"
                            placeholder="Password"
                        />
                        <label for="floatingPassword" class="inputi"
                            >Confirmez votre mot de passe</label
                        >
                    </div>
                    <a
                        class="texti"
                        id="change-form-link"
                        >Déjà inscrit ?</a
                    >
                </div>
                <div class="mt-auto d-flex justify-content-end">
                    <button type="submit" class="btn btn-light">S'inscrire</button>
                </div>
                </div>
            </form>
            `;
        } else {
            formContent.innerHTML = `
                <!-- Contenu du formulaire de connexion -->
                <form method="post" action="login/" >
                    <div class="container mignon" id="form-content">
                        <div class="form-floating mb-3 formi">
                            <input
                                type="email"
                                class="form-control zoni"
                                id="floatingInput"
                                name="identifiant"
                                placeholder="name@example.com"
                            />
                            <label for="floatingInput">Adresse mail</label>
                        </div>
                        <div class="form-floating">
                            <input
                                type="password"
                                class="form-control zoni"
                                id="floatingPassword"
                                name="mdp"
                                placeholder="Password"
                            />
                            <label for="floatingPassword">Mot de passe</label>
                        </div>
                        <a id="change-form-link" class="texti" href="#"
                            >Pas encore inscrit ?</a
                        >
                        <div class="mt-auto d-flex justify-content-end">
                            <button type="submit" class="btn btn-light">Me connecter</button>
                        </div>
                    </div>
                </form>
            `;
        }
        changeFormLink = document.getElementById("change-form-link");
        changeFormLink.addEventListener("click", toggleForm);
    }
    var changeFormLink = document.getElementById("change-form-link");
    changeFormLink.addEventListener("click", toggleForm);
});
var modal = document.getElementById("errorModal");
var span = document.getElementsByClassName("close")[0];

function showError() {
    document.getElementById("errorMessage").innerText =
        "Erreur lors de la connexion ! Veuillez réessayer !";
    modal.style.display = "block";
}

span.onclick = function () {
    modal.style.display = "none";
};

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
