<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Parent Dashboard Website</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">



<style>
/* Reset and Base Styles */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
  }

  

/* Container */
.container {
  max-width: 100%;
  width: 100%;
  margin: 0 auto;
  padding: 0 20px;
  box-sizing: border-box;
  object-fit: cover;
}


/************ HERO SECTION **************/

.hero{
  background: linear-gradient(135deg, #ffe9b3, #fff3d6);
  padding:140px 0 60px;
  box-shadow: 0px 4px 4px 0px #00000040;
}

.hero-info{
  display:flex;
  align-items:center;
  justify-content:space-between;
  flex-wrap:nowrap;
  margin: 0px -15px;
}

.hero-content, .hero-image{
  width: 50%;
  padding: 0px 15px;
}

.hero-tag{
  display:inline-block;
  background:#ffa200;
  color:#fff;
  padding:6px 14px;
  border-radius:20px;
  font-size:13px;
  font-family:'Poppins',sans-serif;
}

.hero-content h1{
  font-size:40px;
  font-weight:700;
  font-family:"Poppins", sans-serif;
  letter-spacing: 2%;
  line-height:1.2;
  color:#222;
}

.hero-content p{
  margin:18px 0 28px;
  color:#444;
  font-size:16px;
  font-family:'Poppins',sans-serif;
  line-height:1.6;
}



.hero-btn{
  display:inline-block;
  background: linear-gradient(106.58deg, #F98C01 53.83%, #935301 133.12%);
  box-shadow: 0px 3.89px 3.89px 0px #00000040;
  color:#fff;
  padding:12px 26px;
  border-radius:8px;
  font-weight:500;
  text-decoration:none;
  font-family:'Poppins',sans-serif;
  transition:0.3s;
}


.hero-image{
  width: 50%;
  padding: 0px 15px;
}

.navbar .logo img {
    width: 100px;
    height: auto;
    max-width: 100%;
    display: block;
}

.navbar .logo a {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}


.logo img {
    width: 100px;
    height: auto;
    max-width: 100%;
    display: block;
}

.hero-image img {
    width: 100%;
    border-radius: 100%;
    height: 100%;
    background-color: #ffb703;
    padding: 5px;
    object-fit: cover;
}
/************ HERO SECTION RESPONSIVE **************/
@media(max-width:768px){
  .hero-container{
    text-align:center;
  }

  .hero-content h1{
    font-size:32px;
  }

  .hero-image img{
    width:100%;
    max-width:320px;
  }
}

/************ PROFILE SECTION **************/
.section-title{
 text-align:center;
 font-size:26px;
 margin-top:40px;
 font-weight:700;
}

.profile-area{
 width:90%;
 max-width:950px;
 margin:30px auto;
 background:#fff;
 border:1px solid #ffe9b3;
 padding:25px;
 border-radius:10px;
 box-shadow:0 10px 25px rgba(0,0,0,.12);
}

/********** CHILD ICONS **********/
.child-switch{
 display:flex;
 align-items:center;
 gap:12px;
 margin-bottom:10px;
}

.child-switch img{
 width:60px;
 height:60px;
 border-radius:50%;
 object-fit:cover;
 border:3px solid #fff;
 box-shadow:0 6px 18px rgba(0,0,0,.2);
}

/* ADD CHILD CIRCLE */
.add-child{
 width:60px;
 height:60px;
 border-radius:50%;
 border:2px dashed #ff9800;
 color:#ff9800;
 font-size:30px;
 font-weight:700;
 display:flex;
 justify-content:center;
 align-items:center;
 text-decoration:none;
 background:#ffe9b3;
 box-shadow:0 6px 18px rgba(0,0,0,.2);
 transition:.3s;
}

.add-child:hover{
 background:#ff9800;
 color:#fff;
}

/******** INFO **********/
.info-row{
 margin-top:15px;
 font-size:15px;
}

.highlight{
 color:#ff6d00;
 font-weight:600;
}

.update-box{
 margin-top:12px;
 background:#fff5d6;
 padding:10px;
 border-left:5px solid #ffa200;
}

.inputs{
 margin-top:12px;
}

.inputs input{
 width:120px;
 padding:7px;
 border-radius:8px;
 border:2px solid #ffcc7a;
 outline:none;
 text-align:center;
 font-weight:600;
}

.submit-btn{
 margin-top:12px;
 padding:9px 25px;
 background:#ff8c00;
 border:none;
 color:white;
 border-radius:6px;
 cursor:pointer;
 transition:.3s;
}

.submit-btn:hover{
 background:#e67400;
}

/************** MILESTONE BOX **************/
.milestone-box{
 width:90%;
 max-width:950px;
 margin:25px auto;
 padding:18px;
 border-radius:10px;
 background:linear-gradient(135deg,#ff9800);
 color:#fff;
 display:flex;
 justify-content:space-between;
 align-items:center;
}

.tag{
 background:#ffe9b3;
 color:#ff9800;
 padding:4px 10px;
 border-radius:20px;
 font-size:11px;
 font-weight:700;
 display:inline-block;
 margin-top:5px;
}

.game-box{
 margin-top:10px;
 background:rgba(255,255,255,.25);
 padding:8px 14px;
 border-radius:8px;
 font-size:13px;
 font-weight:600;
 display:inline-block;
}

.progress-section{
    text-align:center;
    padding:50px 0;
    font-family:Poppins, Arial;
}

.title{
    font-size:28px;
    font-weight:700;
    margin-bottom:35px;
}

.progress-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
    width:85%;
    margin:auto;
}

.progress-card{
    background:#ffe9b3;
    padding:25px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.circle{
    width:110px;
    height:110px;
    border-radius:50%;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:600;
    border:8px solid #ccc;
}

/* Responsive */
@media(max-width:992px){
    .progress-grid{ grid-template-columns:repeat(2,1fr); }
}
@media(max-width:600px){
    .progress-grid{ grid-template-columns:1fr; }
}
.observer-section{
    width:100%;
    padding:40px 0;
    background:#fff4d4;
    text-align:center;
    font-family:Poppins, Arial;
}

/* Title */
.observer-title{
    font-size:26px;
    font-weight:700;
    margin-bottom:15px;
    position:relative;
}

/* Underline effect */
.observer-title::after{
    content:"";
    width:120px;
    height:4px;
    background:linear-gradient(to right,#ffcc66,#ff8c00);
    display:block;
    margin:8px auto 0;
    border-radius:3px;
}

/* Note Box */
.observer-box{
    width:70%;
    margin:auto;
    background: #ffe9b3;
    padding:35px 10px;
    border-radius:12px;
    border:2px solid #ffd36b;
    font-size:18px;
    font-style:italic;
    font-weight:500;
    color:#333;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

/* Responsive */
@media(max-width:768px){
    .observer-box{
        width:90%;
        font-size:16px;
    }
}
body{
  margin:0;
  font-family:Arial, sans-serif;
  background:#fff4cc;
}

.growth-section{
  padding:60px 5%;
}

.section-title{
  text-align:center;
  font-size:30px;
  margin-bottom:40px;
}

.growth-wrapper{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(350px,1fr));
  gap:30px;
}

.growth-card{
  background:#fff;
  border-radius:20px;
  padding:25px;
  border:2px solid #ffcc33;
}

.chart{
  display:flex;
}

.y-axis{
  display:flex;
  flex-direction:column;
  justify-content:space-between;
  font-size:13px;
  margin-right:10px;
}

.graph-area{
  position:relative;
  flex:1;
  height:230px;
  border-left:2px solid #777;
  border-bottom:2px solid #777;
}

.line{
  position:absolute;
  inset:0;
  cursor:pointer;
}

.points span{
  position:absolute;
  width:10px;
  height:10px;
  background:#ffcc00;
  border-radius:50%;
  transform:translate(-50%,50%);
  cursor:pointer;
}

.months{
  position:absolute;
  bottom:-28px;
  width:100%;
  display:flex;
  justify-content:space-between;
  font-size:13px;
}

/* Tooltip */
#tooltip{
  position:absolute;
  background:#000;
  color:#fff;
  padding:6px 10px;
  font-size:13px;
  border-radius:6px;
  display:none;
  pointer-events:none;
  z-index:999;
}


/* ===============================
   EXTRA SMALL DEVICES (≤360px)
================================ */
@media (max-width: 360px) {
  .hero {
    padding: 110px 0 40px;
  }

  .hero-content h1 {
    font-size: 26px;
  }

  .hero-content p {
    font-size: 14px;
  }

  .hero-btn {
    padding: 10px 18px;
    font-size: 14px;
  }

  .child-switch img,
  .add-child {
    width: 50px;
    height: 50px;
  }

  .inputs input {
    width: 100px;
  }
}

/* ===============================
   SMALL MOBILE (≤480px)
================================ */
@media (max-width: 480px) {
  .hero-info {
    flex-direction: column;
    text-align: center;
  }

  .hero-content,
  .hero-image {
    width: 100%;
  }

  .hero-image img {
    max-width: 260px;
    margin: 25px auto 0;
  }

  .profile-area,
  .milestone-box,
  .growth-card {
    width: 95%;
  }

  .milestone-box {
    flex-direction: column;
    text-align: center;
    gap: 15px;
  }
}

/* ===============================
   MOBILE / PHABLET (≤600px)
================================ */
@media (max-width: 600px) {
  .progress-grid {
    grid-template-columns: 1fr;
    width: 95%;
  }

  .observer-box {
    width: 95%;
  }

  .growth-wrapper {
    grid-template-columns: 1fr;
  }
}

/* ===============================
   TABLET (≤768px)
================================ */
@media (max-width: 768px) {
  .hero {
    padding: 120px 0 50px;
  }

  .hero-content h1 {
    font-size: 32px;
  }

  .hero-info {
    flex-wrap: wrap;
  }

  .hero-content,
  .hero-image {
    width: 100%;
  }

  .hero-image img {
    max-width: 320px;
  }

  .milestone-box {
    flex-direction: column;
    gap: 12px;
  }
}

/* ===============================
   SMALL LAPTOP (≤1024px)
================================ */
@media (max-width: 1024px) {
  .hero-content h1 {
    font-size: 36px;
  }

  .progress-grid {
    grid-template-columns: repeat(2, 1fr);
    width: 90%;
  }

  .observer-box {
    width: 80%;
  }
}

/* ===============================
   DESKTOP (≥1200px)
================================ */
@media (min-width: 1200px) {
  .container {
    max-width: 1200px;
  }

  .hero-content h1 {
    font-size: 42px;
  }

  .progress-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* ===============================
   EXTRA LARGE / 2XL (≥1440px)
================================ */
@media (min-width: 1440px) {
  .container {
    max-width: 1400px;
  }

  .hero-content h1 {
    font-size: 46px;
  }

  .hero-content p {
    font-size: 17px;
    max-width: 600px;
  }

  .observer-box {
    width: 65%;
    font-size: 19px;
  }
}

/* ===============================
   ULTRA WIDE / 4K (≥1800px)
================================ */
@media (min-width: 1800px) {
  .container {
    max-width: 1600px;
  }

  .hero-content h1 {
    font-size: 50px;
  }

  .progress-grid {
    width: 80%;
  }

  .observer-box {
    width: 60%;
    font-size: 20px;
  }
}
body {
    background-color: #fff4cc !important;
}


</style>
</head>

<body>
<!-- HEADER INCLUDE -->
<div id="header"></div>

<!-- start hero section -->
<section class="hero">
  <div class="container">
    <div class="hero-info">
      <div class="hero-content">
        <span class="hero-tag">Parent Dashboard</span>
        <h1>Track Your Child’s <br>Growth & Development </h1>
        <p>Monitor learning milestones, physical growth, and development progress in one simple and smart dashboard.</p>
        <a href="../milestone/milestone.php" class="hero-btn">
          View Milestone Tracker 
        </a>
      </div>

      <div class="hero-image">
        <img src="../Assets/img/hero_bg.png" alt="Child development">
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <h2 class="section-title">Child Profile</h2>
    <div class="profile-area">

    <!--  HERE — 2 Photos + Add Button -->
    <div class="child-switch" id="childSwitch">
  <!-- children will load from API -->
      <a href="../child/add_child.php" class="add-child">+</a>
    </div>

    <div class="info-row" id="childNameAge">
    </div>

    <div class="info-row" id="childCenter">
    </div>

    <div class="info-row" id="displayData">
    </div>

    <div class="update-box">
      Last Check: 1 Month Ago | Next Check: Today <br>
      <b>Today physical data update required</b>
    </div>

    <div class="inputs">
      Height: <input type="number" id="heightInput" placeholder="cm">
      Weight: <input type="number" id="weightInput" placeholder="kg">
    </div>

    <button class="submit-btn" id="updatePhysicalBtn">Submit</button>
    </div>

    <a href="../milestone/milestone.php" style="text-decoration:none; color:inherit;">
      <div class="milestone-box">
      <div>
        <h3>Milestone Tracker</h3>
        <span class="tag">Today's Task Completed</span>
        <p>Daily tasks to support your child's development</p>

        <div class="game-box">🎮 Play Development Game →</div>
      </div>

      <h1 id="milestoneCount">0/0</h1>
      </div>
      </a>
  </div>
</section>



<section class="progress-section">
    <h2 class="title">Development Progress</h2>

    <div class="progress-grid">

        <div class="progress-card" data-score="70">
            <div class="circle"><span></span></div>
            <h3>Language</h3>
            <p>Your children's speaking or linguistic skills</p>
        </div>

        <div class="progress-card" data-score="90">
            <div class="circle"><span></span></div>
            <h3>Motor</h3>
            <p>Your children's physical abilities that allow them to use muscles</p>
        </div>

        <div class="progress-card" data-score="40">
            <div class="circle"><span></span></div>
            <h3>Cognitive</h3>
            <p>Your children mental abilities that enable them to think</p>
        </div>

        <div class="progress-card" data-score="100">
            <div class="circle"><span></span></div>
            <h3>Social</h3>
            <p>Your children abilities that enable people to communicate</p>
        </div>

    </div>
</section>
<section class="observer-section">
    <h2 class="observer-title">Observer’s Note</h2>

    <div class="observer-box">
        “Karan should focus 
        <br>
        on developing his cognitive skills”
    </div>
</section>
<!-- ================== REAL GROWTH CHART (HEIGHT + WEIGHT) ================== -->
<section class="growth-section">
  <h2 class="section-title">Growth Progress</h2>

  <div class="growth-wrapper">

    <!-- HEIGHT CHART -->
    <div class="growth-card">
      <h3>🙂 Children Height Growth</h3>
      <canvas id="heightChart"></canvas>
    </div>

    <!-- WEIGHT CHART -->
    <div class="growth-card">
      <h3>🙂 Children Weight Growth</h3>
      <canvas id="weightChart"></canvas>
    </div>

  </div>
</section>




<!-- Tooltip -->
<div id="tooltip"></div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../Assets/js/dashboard.js"></script>
<script src="../Assets/js/growth.js"></script>
<!-- footer include -->
<div id="footer"></div>
<script src="../layout/layout.js"></script>
</body>
</html>
