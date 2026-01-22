document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    console.log("Login JS loaded"); // 🔍 DEBUG

    if (!loginForm) {
        console.log("Login form not found");
        return;
    }

    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();
        console.log("Form submitted");

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();

        if (!email || !password) {
            alert("Please enter email/mobile and password");
            return;
        }

        const formData = new FormData();
        formData.append("email", email);
        formData.append("password", password);
        formData.append("type", "parent");
        formData.append("isApi", "1");

        alert("Logging in...");

        fetch("https://hustle-7c68d043.mileswebhosting.com/spacece/api/login", {
            method: "POST",
            mode: "no-cors",   // required for localhost
            body: formData
        })
        .then(() => {
            alert("Login successful");

            // ✅ CORRECT REDIRECT
            window.location.href = "../dashboard/Parent_Dashboard.php";
        })
        .catch(() => {
            alert("Server error. Try again.");
        });
    });
});
