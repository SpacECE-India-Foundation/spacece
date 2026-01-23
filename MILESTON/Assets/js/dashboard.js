/* ============================================
   BASE URL
============================================ */
const BASE_URL = "https://hustle-7c68d043.mileswebhosting.com/spacece/api";

/* ============================================
   LOAD CHILD LIST ON DASHBOARD
============================================ */
async function loadChildren() {
    try {
        let userId = localStorage.getItem("user_id");

        const res = await fetch(`${BASE_URL}/api_get_child.php?userId=${userId}`);
        const data = await res.json();

        if (data.status !== 200) return;

        const children = data.data;
        const container = document.getElementById("childSwitch");

        container.innerHTML = "";

        children.forEach((child, index) => {
            let btn = document.createElement("img");
            btn.src = child.child_image || "../Assets/img/user.png";
            btn.style.cursor = "pointer";

            btn.onclick = () =>
                switchChild(child.id, child.name, child.age, child.center);

            container.appendChild(btn);

            // 👉 AUTO SELECT FIRST CHILD
            if (index === 0 && !localStorage.getItem("child_id")) {
                switchChild(child.id, child.name, child.age, child.center);
            }
        });

    } catch (err) {
        console.log("Child Load Error:", err);
    }
}


/* ============================================
   SWITCH CHILD
============================================ */
function switchChild(id, name, age, center) {
    localStorage.setItem("child_id", id);
    localStorage.setItem("child_name", name);
    localStorage.setItem("child_age", age);
    localStorage.setItem("child_center", center);

    document.dispatchEvent(new Event("child_switched"));

    loadChildDetails();
    loadMilestoneStatus();
}

/* ============================================
   LOAD CHILD DETAILS
============================================ */
function loadChildDetails() {
    document.getElementById("childNameAge").innerHTML =
        `${localStorage.getItem("child_name")} | ${localStorage.getItem("child_age")} Years`;

    document.getElementById("childCenter").innerHTML =
        `Center: ${localStorage.getItem("child_center")}`;
}

/* ============================================
   UPDATE HEIGHT & WEIGHT (Button)
============================================ */
document.getElementById("updatePhysicalBtn").addEventListener("click", async () => {
    let height = document.getElementById("heightInput").value;
    let weight = document.getElementById("weightInput").value;

    if (!height || !weight) {
        alert("Please enter height & weight.");
        return;
    }

    let userId = localStorage.getItem("user_id");
    let childId = localStorage.getItem("child_id");

    const formData = new FormData();
    formData.append("userId", userId);
    formData.append("childId", childId);
    formData.append("height", height);
    formData.append("weight", weight);

    try {
        const res = await fetch(`${BASE_URL}/api_update_child.php`, {
            method: "POST",
            body: formData
        });

        const data = await res.json();

        alert(data.message);
        loadChildDetails();

    } catch (err) {
        console.log("Update Physical Error:", err);
    }
});

/* ============================================
   LOAD MILESTONE STATUS (MAIN PART)
============================================ */
async function loadMilestoneStatus() {
    try {
        let userId = localStorage.getItem("user_id");
        let childId = localStorage.getItem("child_id");

        if (!userId || !childId) return;

        const res = await fetch(`${BASE_URL}/Get_MilesStoneTask.php?userId=${userId}&childId=${childId}`);
        const data = await res.json();

        console.log("Milestone Dashboard Data:", data);

        if (data.status === 200) {
            document.getElementById("milestoneCount").innerText = data.data.milestones;
        }

    } catch (err) {
        console.log("Milestone Load Error:", err);
    }
}

/* ============================================
   AUTO RELOAD WHEN CHILD SWITCHES
============================================ */
document.addEventListener("child_switched", () => {
    loadChildDetails();
    loadMilestoneStatus();
});

/* ============================================
   FIRST PAGE LOAD
============================================ */
document.addEventListener("DOMContentLoaded", () => {
    loadChildren();
    loadChildDetails();
    loadMilestoneStatus();
});
