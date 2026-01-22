// ==============================
// FORGOT PASSWORD (STEP 1)
// ==============================
document.addEventListener("DOMContentLoaded", () => {
  const forgotForm = document.getElementById("forgotForm");

  if (forgotForm) {
    forgotForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const loginId = document.getElementById("login_id").value.trim();

      if (!loginId) {
        alert("Please enter email or mobile number");
        return;
      }

      // Store for next step
      localStorage.setItem("reset_login_id", loginId);

      // Redirect to reset page
      window.location.href = "reset-password.php";
    });
  }
});


// ==============================
// RESET PASSWORD (STEP 2)
// ==============================
document.addEventListener("DOMContentLoaded", () => {
  const resetForm = document.getElementById("resetForm");

  if (!resetForm) return;

  resetForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const newPassword = document.getElementById("new_password").value.trim();
    const confirmPassword = document.getElementById("confirm_password").value.trim();
    const loginId = localStorage.getItem("reset_login_id");

    if (!newPassword || !confirmPassword) {
      alert("All fields are required");
      return;
    }

    if (newPassword !== confirmPassword) {
      alert("Passwords do not match");
      return;
    }

    if (!loginId) {
      alert("Session expired. Please try again.");
      window.location.href = "forgot-password.php";
      return;
    }

    const formData = new FormData();

    // Detect email or mobile
    if (/^\d{10}$/.test(loginId)) {
      formData.append("mobile", loginId);
    } else {
      formData.append("email", loginId);
    }

    formData.append("newPassword", newPassword);

    try {
      const response = await fetch(
        "https://hustle-7c68d043.mileswebhosting.com/spacece/api/changePassword",
        {
          method: "POST",
          body: formData,
        }
      );

      const result = await response.json();
      console.log(result);

      if (result.status === true) {
        alert("Password updated successfully");
        localStorage.removeItem("reset_login_id");
        window.location.href = "login.php";
      } else {
        alert(result.message || "Password reset failed");
      }
    } catch (error) {
      console.error("Reset Error:", error);
      alert("Server error. Please try again.");
    }
  });
});


