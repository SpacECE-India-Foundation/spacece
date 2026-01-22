const BASE_URL = "https://hustle-7c68d043.mileswebhosting.com/spacece/api";

const userArea = document.getElementById("userArea");
const userId = localStorage.getItem("user_id");

/* =====================================================
   INIT HEADER
===================================================== */
document.addEventListener("DOMContentLoaded", () => {
  if (userId) {
    loadUserProfile();
  } else {
    showLoginIcon();
  }
});

/* =====================================================
   SHOW LOGIN ICON
===================================================== */
function showLoginIcon() {
  userArea.innerHTML = `
    <a href="../auth/login.php" class="icon-link">
      <i class="fa-regular fa-circle-user"></i>
    </a>
  `;
}

/* =====================================================
   LOAD USER PROFILE (API)
===================================================== */
async function loadUserProfile() {
  try {
    const res = await fetch(`${BASE_URL}/getUserProfile?userId=${userId}`);
    const data = await res.json();

    if (!data.status) {
      localStorage.clear();
      showLoginIcon();
      return;
    }

    renderProfileMenu(data.user);

  } catch (err) {
    console.error("Profile load error", err);
    showLoginIcon();
  }
}

/* =====================================================
   RENDER PROFILE MENU
===================================================== */
function renderProfileMenu(user) {
  const image =
    user.profileImage
      ? user.profileImage
      : "../MILESTONE_HEADER_FOOTER/assets/img/default-user.png";

  userArea.innerHTML = `
    <a href="../dashboard/Parent_Dashboard.php" class="icon-link">
      <i class="fa-solid fa-house"></i>
    </a>

    <div class="profile-menu">
      <img src="${image}" class="profile-img" id="profileToggle">

      <div class="profile-dropdown" id="profileDropdown">
        <div class="profile-info">
          <strong>${user.name}</strong>
        </div>

        <a href="../auth/profile.php">
          <i class="fa-regular fa-user"></i>
          <span>My Profile</span>
        </a>

        <a href="../auth/update-profile.php">
          <i class="fa-solid fa-pen"></i>
          <span>Update Profile</span>
        </a>

        <a href="#" onclick="logout()" class="logout">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Logout</span>
        </a>
      </div>
    </div>
  `;

  attachDropdownEvents();
}

/* =====================================================
   DROPDOWN TOGGLE
===================================================== */
function attachDropdownEvents() {
  const toggle = document.getElementById("profileToggle");
  const dropdown = document.getElementById("profileDropdown");

  toggle.addEventListener("click", e => {
    e.stopPropagation();
    dropdown.classList.toggle("show");
  });

  document.addEventListener("click", () => {
    dropdown.classList.remove("show");
  });
}

/* =====================================================
   LOGOUT
===================================================== */
function logout() {
  localStorage.clear();
  window.location.href = "../auth/login.php";
}
