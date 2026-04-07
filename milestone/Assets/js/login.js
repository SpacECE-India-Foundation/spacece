document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    console.log("Login JS loaded");

    if (!loginForm) {
        console.log("Login form not found");
        return;
    }

    loginForm.addEventListener("submit", async function (e) {
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

        try {
            const response = await fetch("https://hustle-7c68d043.mileswebhosting.com/spacece/api/login", {
                method: "POST",
                body: formData
            });

            const result = await response.json();
            console.log("Login result:", result);

            if (result.status === true || result.status === 200) {
                localStorage.setItem("user_id", result.data?.userId || result.userId || result.id);
                window.location.href = "../dashboard/Parent_Dashboard.php";
            } else {
                alert(result.message || "Login failed.");
            }

        } catch (err) {
            console.error("Login error:", err);
            alert("Server error. Try again.");
        }

    });

});