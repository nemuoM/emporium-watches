document.addEventListener("DOMContentLoaded", function () {
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
});
