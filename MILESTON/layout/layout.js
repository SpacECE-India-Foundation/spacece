
/* ==============================
   LOAD HEADER & FOOTER
============================== */
async function loadLayout() {
  document.getElementById("header").innerHTML =
    await fetch("../layout/header.php").then(res => res.text());


  document.getElementById("footer").innerHTML =
    await fetch("../layout/footer.php").then(res => res.text());


  // loadUserProfile();
}


/* ==============================
   LOAD USER DATA
============================== */
// async function loadUserProfile() {
//   const userId = localStorage.getItem("user_id");
//   if (!userId) return;

//   try {
//     const res = await fetch(`${BASE_URL}/getUserProfile?userId=${userId}`);
//     const data = await res.json();

//     if (data.status) {
//       document.getElementById("profileName").innerText = data.data.name;
//       document.getElementById("profileToggle").src =
//         data.data.profile_image || "../assets/img/default-user.png";
//     }
//   } catch (e) {
//     console.error("Profile load failed");
//   }
// }

/* ==============================
   LOGOUT
============================== */
function logout() {
  localStorage.clear();
  window.location.href = "../auth/login.php";
}

/* ==============================
   DROPDOWN
============================== */
document.addEventListener("click", e => {
  const dropdown = document.getElementById("profileDropdown");
  const toggle = document.getElementById("profileToggle");

  if (toggle && toggle.contains(e.target)) {
    dropdown.classList.toggle("show");
  } else {
    dropdown?.classList.remove("show");
  }
});

document.addEventListener("DOMContentLoaded", loadLayout);
