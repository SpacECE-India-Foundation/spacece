document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm");
    const msg = document.getElementById("formMessage");

    form.addEventListener("submit", async function (e) {
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

        try {
            const response = await fetch("https://hustle-7c68d043.mileswebhosting.com/spacece/api/registration", {
                method: "POST",
                body: formData
            });

            const result = await response.json();
            console.log("Signup result:", result);

            if (result.status === true || result.status === 200) {
                showMsg("Account created successfully. Redirecting...", "green");
                setTimeout(() => {
                    window.location.href = "../auth/login.php";
                }, 1500);
            } else {
                showMsg(result.message || "Registration failed.", "red");
            }

        } catch (err) {
            console.error("Signup error:", err);
            showMsg("Server not reachable. Try again.", "red");
        }

    });

    function showMsg(text, color) {
        msg.style.color = color;
        msg.innerText = text;
    }

});