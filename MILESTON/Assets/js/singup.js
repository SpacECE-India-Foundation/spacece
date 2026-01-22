document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm");
    const msg = document.getElementById("formMessage");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const password = document.getElementById("password").value.trim();

        if (!name || !email || !phone || !password) {
            showMsg("All fields are required", "red");
            return;
        }

        const formData = new FormData();
        formData.append("name", name);
        formData.append("email", email);
        formData.append("phone", phone);
        formData.append("password", password);
        formData.append("type", "parent");

        showMsg("Please wait... Creating account", "#f6a609");

        fetch("https://hustle-7c68d043.mileswebhosting.com/spacece/api/registration", {
            method: "POST",
            mode: "no-cors",   // 🔥 THIS MAKES IT RUN
            body: formData
        })
        .then(() => {
            // Response read nahi kar sakte (browser restriction)
            showMsg("Account created successfully. Redirecting...", "green");

            setTimeout(() => {
                window.location.href = "../auth/login.php";
            }, 1500);
        })
        .catch(() => {
            showMsg("Server not reachable. Try again.", "red");
        });
    });

    function showMsg(text, color) {
        msg.style.color = color;
        msg.innerText = text;
    }
});
