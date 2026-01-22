// document.addEventListener("DOMContentLoaded", function () {

//     const form = document.querySelector("form");
//     const emailInput = document.querySelector("input[name='email']");
//     const passwordInput = document.querySelector("input[name='password']");
//     const togglePassword = document.querySelector(".toggle-password");
//     const submitBtn = document.querySelector("button[type='submit']");
//     const errorBox = document.querySelector(".error-message");
//     const loader = document.querySelector(".loader");

//     if (!form) return;

//     // 👁 Show / Hide Password
//     if (togglePassword) {
//         togglePassword.addEventListener("click", function () {
//             if (passwordInput.type === "password") {
//                 passwordInput.type = "text";
//                 this.innerText = "🙈";
//             } else {
//                 passwordInput.type = "password";
//                 this.innerText = "👁";
//             }
//         });
//     }



//     // Form Submit
//     form.addEventListener("submit", function (e) {

//         let valid = true;
//         errorBox.innerText = "";
//         errorBox.style.display = "none";

//         emailInput.style.borderColor = "#ccc";
//         passwordInput.style.borderColor = "#ccc";

//         // ✅ Email validation
//         const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

//         if (!emailPattern.test(emailInput.value.trim())) {
//             emailInput.style.borderColor = "red";
//             errorBox.innerText = "Please enter a valid email address.";
//             valid = false;
//         }

//         if (passwordInput.value.trim() === "") {
//             passwordInput.style.borderColor = "red";
//             errorBox.innerText = "Password is required.";
//             valid = false;
//         }

//         if (!valid) {
//             e.preventDefault();
//             errorBox.style.display = "block";
//             return;
//         }

//         // 🔐 Disable button + ⏳ Loader
//         submitBtn.disabled = true;
//         submitBtn.innerText = "Logging in...";
//         if (loader) loader.style.display = "inline-block";
//     });
// });



document.addEventListener("DOMContentLoaded", function () {
    // Optional future animations or logic
    console.log("Splash screen loaded successfully");
});
