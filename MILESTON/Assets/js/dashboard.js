/*******************************
 CONFIG
********************************/
const BASE_URL = "https://hustle-7c68d043.mileswebhosting.com/spacece/api";
const userId = localStorage.getItem("user_id") || 18;

let selectedChildId = null;

/*******************************
 LOAD CHILDREN
********************************/
async function loadChildren() {
  try {
    const res = await fetch(`${BASE_URL}/getAllChild.php?userId=${userId}`);
    const data = await res.json();

    const childSwitch = document.getElementById("childSwitch"); // ✅ ADD THIS
    if (!childSwitch) return;

    childSwitch.innerHTML = `<a href="../child/add_child.php" class="add-child">+</a>`;

    if (!data.status || !data.data || !data.data.children.length) {
      document.getElementById("childNameAge").innerText = "No children added";
      return;
    }

    data.data.children.forEach((child, index) => {
      const img = document.createElement("img");

      // ⭐ FINAL FIX — FULL URL
      img.src = `${BASE_URL}/${child.image}`;
      img.alt = child.childName;

      img.onclick = () => selectChild(child);

      childSwitch.prepend(img);

      if (index === 0) selectChild(child);
    });


  } catch (err) {
    console.error("Child load error", err);
  }
}
loadChildren();
/*******************************
 SELECT CHILD
********************************/
function selectChild(child) {

  // FIX selected child ID
  selectedChildId = child.childId;

  // FIX DOB format (DD/MM/YYYY → YYYY-MM-DD)
  let dobFixed = child.dob ? child.dob.split("/").reverse().join("-") : null;

  const age = calculateAge(dobFixed);

  // Show name + age
  document.getElementById("childNameAge").innerHTML =
    `<b>${child.childName}</b> | <span class="highlight">${age} Years</span>`;

  // Show center
  document.getElementById("childCenter").innerText =
    `Center: ${child.center || "Not Assigned"}`;

  // Show height/weight
  document.getElementById("displayData").innerText =
    `Height: ${child.height || "--"} cm | Weight: ${child.weight || "--"} kg`;

  loadGrowthChart(child);
}


/*******************************
 AGE CALCULATION
********************************/
function calculateAge(dob) {
  if (!dob) return "--";
  const birth = new Date(dob);
  const today = new Date();
  let age = today.getFullYear() - birth.getFullYear();
  const m = today.getMonth() - birth.getMonth();
  if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
  return age;
}

/*******************************
 UPDATE HEIGHT & WEIGHT
********************************/
const updateBtn = document.getElementById("updatePhysicalBtn");

if (updateBtn) {
  updateBtn.addEventListener("click", async () => {
    const height = document.getElementById("heightInput").value;
    const weight = document.getElementById("weightInput").value;

    if (!height || !weight || !selectedChildId) {
      alert("Please select child and enter height & weight");
      return;
    }

    const formData = new FormData();
    formData.append("height", height);
    formData.append("weight", weight);

    try {
      const res = await fetch(
        `${BASE_URL}/updateChildGrowth_MilesStone.php?userId=${userId}&childId=${selectedChildId}`,
        {
          method: "POST",     // REQUIRED
          body: formData
        }
      );

      const data = await res.json();

      if (data.status === 200) {   // CORRECT SUCCESS CHECK
        document.getElementById("displayData").innerText =
          `Height: ${height} cm | Weight: ${weight} kg`;

        document.getElementById("heightInput").value = "";
        document.getElementById("weightInput").value = "";

        alert("Updated successfully!");
      } else {
        alert(data.message || "Update failed");
      }


    } catch (err) {
      console.error("Update error", err);
    }
  });
}

/*******************************
 GROWTH CHART (STATIC DEMO)
********************************/
function loadGrowthChart(child) {
  const container = document.querySelector(".growth-card .points");
  if (!container) return;

  container.innerHTML = "";

  const heightPoints = [
    { x: 20, value: "60 cm" },
    { x: 40, value: "70 cm" },
    { x: 60, value: "80 cm" },
    { x: 80, value: (child.height || "--") + " cm" }
  ];

  heightPoints.forEach(p => {
    const span = document.createElement("span");
    span.style.left = p.x + "%";
    span.style.bottom = "70%";
    span.title = p.value;
    container.appendChild(span);
  });
}

/*******************************
 DEVELOPMENT SCORE
********************************/
document.querySelectorAll(".progress-card").forEach(card => {
  const score = parseInt(card.dataset.score || 0);
  const circle = card.querySelector(".circle");
  if (!circle) return;

  let label = "Developing";
  if (score >= 85) label = "Perfect";
  else if (score >= 70) label = "Excellent";
  else if (score >= 50) label = "Good";

  circle.innerHTML = `<span>${label}</span>`;
});


