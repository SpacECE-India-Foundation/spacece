const BASE_URL = "https://hustle-7c68d043.mileswebhosting.com/spacece/api";
const userId = localStorage.getItem("user_id");

let selectedChildId = null;
let selectedTaskId = null;

/* =====================================
   LOAD CHILDREN
===================================== */
document.addEventListener("DOMContentLoaded", loadChildren);

async function loadChildren() {
  try {
    const res = await fetch(`${BASE_URL}/getAllChild.php?userId=${userId}`);
    const data = await res.json();

    if (!data.status || !data.data.children.length) return;

    const container = document.getElementById("childButtons");
    container.innerHTML = "";

    data.data.children.forEach((child, index) => {
      const btn = document.createElement("button");
      btn.className = "child-btn";
      btn.innerText = child.childName;

      btn.onclick = () => selectChild(child.childId, btn);
      container.appendChild(btn);

      if (index === 0) {
        selectChild(child.childId, btn);
      }
    });

  } catch (err) {
    console.error("Children load error:", err);
  }
}

/* =====================================
   SELECT CHILD
===================================== */
function selectChild(childId, btn) {
  selectedChildId = childId;
  localStorage.setItem("child_id", childId);

  document.querySelectorAll(".child-btn").forEach(b => b.classList.remove("active"));
  btn.classList.add("active");

  loadMilestones();
}

/* =====================================
   LOAD MILESTONES
===================================== */
async function loadMilestones() {
  try {
    const res = await fetch(
      `${BASE_URL}/Get_MilesStoneTask.php?userId=${userId}&childId=${selectedChildId}`
    );

    const data = await res.json();

    console.log("Milestone API Response:", data);

    const container = document.getElementById("milestoneTasks");
    container.innerHTML = "";

    if (!data.status || !data.data || !data.data.tasks || !data.data.tasks.length) {
      container.innerHTML = "<p>No milestones found.</p>";
      return;
    }

    const tasks = data.data.tasks;

    let total = tasks.length;
    let completed = tasks.filter(t => t.isCompleted === true).length;

    tasks.forEach(task => {
      const div = document.createElement("div");
      div.className = "task " + (task.isCompleted ? "completed" : "");

      div.innerHTML = `
        <div class="task-info">
          <p><b>${task.task}</b></p>
          <span class="tag">${task.category}</span><br>
          <small>Target Date: ${task.date}</small>
        </div>

        <div class="check ${task.isCompleted ? "active" : ""}">
          ${task.isCompleted ? "✓" : ""}
        </div>

        <div class="task-actions">
          ${
            !task.isCompleted 
              ? `<button onclick="markComplete('${task.taskId}')">Complete</button>`
              : ""
          }
          <button onclick="openModal('${task.taskId}')">Upload Video</button>
        </div>
      `;

      container.appendChild(div);
    });

    document.getElementById("totalMilestones").innerText = total;
    document.getElementById("completedTasks").innerText = completed;
    document.getElementById("completionCircle").innerText = `${completed}/${total}`;

  } catch (err) {
    console.error("Milestone load error:", err);
  }
}

/* =====================================
   MARK COMPLETE
===================================== */
async function markComplete(taskId) {
  console.log("Mark complete:", taskId);

  const formData = new FormData();
  formData.append("taskId", taskId);
  formData.append("userId", userId);
  formData.append("childId", selectedChildId);
  formData.append("status", 1);

  try {
    const res = await fetch(`${BASE_URL}/Update_TaskMilesStone.php`, {
      method: "POST",
      body: formData
    });

    const data = await res.json();
    console.log("Complete Response:", data);

    if (data.status == 200 || data.status == true) {
      loadMilestones();
    } else {
      alert(data.message);
    }

  } catch (err) {
    console.error("Task update error:", err);
  }
}

/* =====================================
   VIDEO UPLOAD
===================================== */
function openModal(taskId) {
  console.log("OPEN MODAL FOR TASK:", taskId);
  selectedTaskId = taskId;
  document.getElementById("videoModal").style.display = "block";
}

function closeModal() {
  document.getElementById("videoModal").style.display = "none";
  document.getElementById("taskVideo").value = "";
}

async function uploadVideo() {
  const video = document.getElementById("taskVideo").files[0];

  if (!video) {
    alert("Please select a video");
    return;
  }

  const formData = new FormData();
  formData.append("userId", userId);
  formData.append("childId", selectedChildId);
  formData.append("taskId", selectedTaskId);
  formData.append("taskVideo", video);

  try {
    const res = await fetch(`${BASE_URL}/SubmitMilesStone_Task.php`, {
      method: "POST",
      body: formData
    });

    const data = await res.json();
    console.log("UPLOAD RESPONSE:", data);

    if (data.status) {
      alert("Video uploaded successfully!");
      closeModal();
    } else {
      alert(data.message);
    }

  } catch (err) {
    console.error("Video upload error:", err);
  }
}
