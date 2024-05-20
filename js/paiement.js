document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#paiement-form");

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        paiement(); // Correct function name
    });
});

function paiement() {
    const form = document.querySelector("#paiement-form");
    const formData = new FormData(form);

    fetch("valider/", {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                console.log("HTTP status code: " + response.status);
                throw new Error("The request failed");
            }
            return response.json();
        })
        .then(() => {
            window.location.href = "../../../../recapitulatif/";
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
