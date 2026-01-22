<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Completion Status & Tasks - <?php echo $selected_child_id ? 'Child Milestones' : 'Milestone Tracker'; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<!-- <link rel="stylesheet" href="../Assets/css/style.css"> -->
<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
}

body{
  background:#fff7da;
  overflow-x:hidden;
}

/* WRAPPER */
.wrapper{
  max-width:1100px;
  margin:auto;
  padding: 150px 15px 30px 15px;
}

/* ================= CHILD SELECTOR ================= */
.child-selector{
  background:#fff;
  border-radius:15px;
  padding:20px;
  margin-bottom:30px;
  box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.child-selector h3{
  margin-bottom:15px;
  color:#333;
}

.child-buttons{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
}

.child-btn{
  background:#ff9800;
  color:#fff;
  border:none;
  padding:10px 20px;
  border-radius:25px;
  cursor:pointer;
  transition:0.3s;
}

.child-btn:hover,
.child-btn.active{
  background:#e68900;
  transform:translateY(-2px);
}

/* ================= COMPLETION STATUS ================= */
.completion{
  background:linear-gradient(135deg,#f6a623,#f8d350);
  border-radius:20px;
  padding:25px;
  box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.completion h2{
  text-align:center;
  color:#fff;
  margin-bottom:20px;
}

.status-row{
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:20px;
  flex-wrap:wrap;
}

.status-card{
  background:#fff;
  border-radius:14px;
  padding:18px;
  width:200px;
  text-align:center;
}

.status-card p{
  color:#ff7a00;
  font-size:14px;
}

.status-card h3{
  color:#ff7a00;
  font-size:32px;
}

.circle{
  width:120px;
  height:120px;
  background:#f3c623;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#fff;
  font-size:26px;
  font-weight:700;
}

/* ================= TASK SECTIONS ================= */
.tasks{
  margin-top:35px;
  background:#fffbe6;
  border-radius:20px;
  padding:25px;
  box-shadow:0 8px 20px rgba(0,0,0,.12);
}

.tasks.past-tasks{
  background:transparent;
  box-shadow:none;
  padding:10px 0;
}

/* ================= TASK CARD (SAME FOR ALL) ================= */
.task{
  background:#fff;
  border:2px solid #f6c14b;
  border-radius:16px;
  padding:16px;
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
  gap:15px;
  margin-bottom:14px;
  opacity:1;
}

/* completed */
.task.completed p{
  text-decoration:line-through;
  color:#888;
}

/* failed (LOOK SAME) */
.task.failed{
  border:2px solid #f6c14b;
  opacity:1;
}

/* ================= TASK INFO ================= */
.task-info p{
  font-size:15px;
  line-height:1.4;
}

/* TAGS */
.tag{
  display:inline-block;
  margin-top:6px;
  padding:4px 12px;
  border-radius:18px;
  font-size:12px;
  font-weight:500;
}

.language{background:#ffe0a3;}
.motor{background:#d4fff4;}
.cognitive{background:#ffb7b7;}
.social{background:#ccffb8;}

/* ================= CHECK ================= */
.check{
  width:22px;
  height:22px;
  border:2px solid #f6a623;
  border-radius:6px;
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
}

.check.active{
  background:#f6a623;
  color:#fff;
}

/* disable failed cross */
.check.cross{
  background:#ff6b6b;
  color:#fff;
  border-color:#ff6b6b;
  pointer-events:none;
}

/* ================= MILESTONE ================= */
.milestone{
  background:#ffc857;
  border-radius:16px;
  padding:18px;
  margin-top:20px;
}

.milestone-title{
  font-weight:600;
  margin-bottom:10px;
}

.milestone-box{
  background:#fff;
  border-radius:14px;
  padding:14px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:12px;
}

/* UPLOAD */
.upload{
  width:48px;
  height:48px;
  background:#fff;
  border:2px solid #f6a623;
  border-radius:12px;
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  position:relative;
}

.upload input{
  position:absolute;
  inset:0;
  opacity:0;
}

/* VIDEO BADGE */
.video-badge{
  background:#4caf50;
  color:#fff;
  padding:6px 10px;
  border-radius:10px;
  font-size:12px;
  white-space:nowrap;
}

/* DATE */
.date-title{
  text-align:center;
  font-weight:600;
  margin:20px 0 15px;
  color:#333;
}

/* ================= RESPONSIVE ================= */
@media(max-width:768px){
  .status-row{
    justify-content:center;
  }

  .status-card{
    width:100%;
  }

  .task{
    flex-direction:column;
  }

  .check{
    align-self:flex-end;
  }

  .milestone-box{
    flex-direction:column;
    align-items:flex-start;
  }

  .child-buttons{
    justify-content:center;
  }
}
</style>
</head>

<body>

<div id="header"></div>


<div class="wrapper">

  <!-- CHILD SELECTOR -->
  <div class="child-selector">
    <h3>Select Child</h3>
    <div class="child-buttons" id="childButtons">
      <!-- Children buttons from API -->
    </div>
  </div>

  <!-- COMPLETION STATUS -->
  <div class="completion">
    <h2>Completion Status</h2>
    <div class="status-row">
      <div class="status-card">
        <p>Total Milestones</p>
        <h3 id="totalMilestones">0</h3>
      </div>

      <div class="circle" id="completionCircle">0/0</div>

      <div class="status-card">
        <p>Completed Tasks</p>
        <h3 id="completedTasks">0</h3>
      </div>
    </div>
  </div>

  <!-- MILESTONES -->
  <div class="tasks">
    <h2>Milestone Progress</h2>

    <div id="milestoneTasks">
      <!-- Milestone tasks from API -->
    </div>
  </div>

</div>

<!-- Video Upload Modal -->
<div id="videoModal" style="display:none">
  <input type="file" id="taskVideo" accept="video/*">
  <button onclick="uploadVideo()">Upload</button>
  <button onclick="closeModal()">Cancel</button>
</div>


<script src="../Assets/js/milestone.js"></script>



<!-- footer include -->
<div id="footer"></div>
<script src="../layout/layout.js"></script>

</body>
</html>