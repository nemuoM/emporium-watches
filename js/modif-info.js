document.getElementById("info").addEventListener("submit", function (e) {
    e.preventDefault();
    let form = new FormData(this);

    fetch("updtprofil/", {
        method: "POST",
        body: form,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.success);
                location.reload();
            } else {
                alert(data.error);
            }
        });
});

$("#deltebtn").click(function () {
    let form = new FormData();
    form.append("password", $("#password").val());
    fetch("supprimer/", {
        method: "POST",
        body: form,
    })
        .then((response) => {
            if (!response.ok) {
                console.log("HTTP status code: " + response.status);
                throw new Error("The request failed");
            }
            return response.json();
        })
        .then((data) => {
            if (data.error === "Mot de passe incorrect !") {
                alert(data.error);
            } else {
                window.location.href = "../../../../";
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});
