<?php
session_start();
$session_user_id = $_SESSION['current_user_id'] ?? 0;
$session_child_id = $_SESSION['child_id'] ?? 0;
?>
<?php
//  
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = null;
$module_name = null;
$main_page = true;
 
$extra_styles = "
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css' />
";
 
$extra_scripts = "
<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js'></script>
";
 
include_once '../common/header_module.php';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Parent Dashboard Website</title>
 
<meta charset="UTF-8" />
  <meta name="description" content="SpaceEcE" />
  <meta name="keywords" content="LERAMIZ, unica, creative, html" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link href="img/Favicon.ico" rel="shortcut icon" />
 
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" />
 
  <!-- bug id-0000115 -->
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
  <!-- <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 
 
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- </head> -->
 
 
<style>
/* Reset and Base Styles */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
  }
body{
  margin:0;
  height: 100%;
  font-family:Arial, sans-serif;
  background:#fff4cc;
 
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
 margin:40px 0 20px 0;
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
    padding:0 0 50px 0;
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
    padding:0;
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
  padding:0 5% 50px 5%;
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
 
 
        /* Blur Overlay - appears when chatbot opens */
        .blur-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            z-index: 999;
            display: none;
        }
 
        .blur-overlay.active {
            display: block;
        }
 
        /* Chat Container - positioned at bottom right */
        .chat-container {
            position: fixed;
            bottom: 5px;
            right: 30px;
            width: 100%;
            max-width: 380px;
            height: 550px;
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 1001;
            transform: scale(0);
            transition: transform 0.3s ease;
            border: 5px solid #FF9800;
        }
 
        .chat-container.active {
            transform: scale(1);
        }
 
        .chat-header {
            background: linear-gradient(135deg, #FF9800 0%, #FF6B00 100%);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }
 
        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }
 
        .bot-avatar {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            animation: bounce 2s ease-in-out infinite;
        }
 
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
 
        .bot-name {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
 
        .close-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }
 
        .close-btn:hover {
            background: rgba(255,255,255,0.3);
        }
 
        .chat-messages {
            flex: 1;
            padding: 25px 20px;
            overflow-y: auto;
            background: #f5f5f5;
        }
 
        .message {
            margin-bottom: 20px;
            animation: slideIn 0.4s ease;
            clear: both;
        }
 
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
 
        .bot-message {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 20px;
        }
 
        .bot-message .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF9800 0%, #FF6B00 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(255, 152, 0, 0.3);
        }
 
        .bot-message .bubble {
            background: white;
            padding: 14px 18px;
            border-radius: 20px;
            border-top-left-radius: 6px;
            max-width: 70%;
            box-shadow: 0 3px 8px rgba(0,0,0,0.12);
            border: 2px solid #FFE0B2;
        }
 
        .bot-message .label {
            font-weight: 700;
            color: #FF6B00;
            margin-bottom: 6px;
            font-size: 15px;
        }
 
        .bot-message .text {
            color: #444;
            line-height: 1.7;
            font-size: 15px;
        }
 
        .user-message {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
 
        .user-message .bubble {
            background: linear-gradient(135deg, #FF9800 0%, #FF6B00 100%);
            color: white;
            padding: 14px 18px;
            border-radius: 20px;
            border-top-right-radius: 6px;
            max-width: 70%;
            box-shadow: 0 3px 10px rgba(255, 107, 0, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
 
        .user-message .text {
            line-height: 1.7;
            font-size: 15px;
            font-weight: 500;
        }
 
        .timestamp {
            font-size: 12px;
            color: #999;
            margin-top: 6px;
            text-align: right;
        }
 
        .chat-input-container {
            padding: 15px 20px;
            background: white;
            border-top: 1px solid #e0e0e0;
            display: flex;
            gap: 10px;
            align-items: center;
        }
 
        .chat-input {
            flex: 1;
            border: 2px solid #FFB74D;
            border-radius: 25px;
            padding: 14px 20px;
            font-size: 15px;
            font-family: 'Comic Sans MS', cursive;
            outline: none;
            transition: all 0.3s;
        }
 
        .chat-input:focus {
            border-color: #FF9800;
            box-shadow: 0 0 12px rgba(255, 152, 0, 0.2);
        }
 
        .send-btn {
            background: linear-gradient(135deg, #FF9800 0%, #FF6B00 100%);
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(255, 152, 0, 0.4);
        }
 
        .send-btn:hover {
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 7px 20px rgba(255, 152, 0, 0.6);
        }
 
        .send-btn:active {
            transform: scale(0.95);
        }
 
        .floating-chat-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #FF9800 0%, #FF6B00 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(255, 152, 0, 0.5);
            transition: all 0.3s;
            z-index: 1000;
            animation: pulse 2s ease-in-out infinite;
        }
 
        @keyframes pulse {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 8px 25px rgba(255, 152, 0, 0.5);
            }
            50% { 
                transform: scale(1.08);
                box-shadow: 0 12px 35px rgba(255, 152, 0, 0.7);
            }
        }
 
        .floating-chat-btn:hover {
            transform: scale(1.15) rotate(15deg);
            animation: none;
        }
 
        .hidden {
            display: none;
        }
 
        /* Child-friendly scrollbar */
        .chat-messages::-webkit-scrollbar {
            width: 10px;
        }
 
        .chat-messages::-webkit-scrollbar-track {
            background: #FFE0B2;
            border-radius: 10px;
        }
 
        .chat-messages::-webkit-scrollbar-thumb {
            background: #FF9800;
            border-radius: 10px;
            border: 2px solid #FFE0B2;
        }
 
        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: #FF6B00;
        }
 
        @media (max-width: 480px) {
            .chat-container {
                right: 10px;
                bottom: 90px;
                max-width: calc(100% - 20px);
                height: 500px;
            }
 
            .floating-chat-btn {
                right: 20px;
                bottom: 20px;
                width: 65px;
                height: 65px;
                font-size: 32px;
            }
        }
</style>
</head>
 
<body>
 <input type="hidden" id="sessionUserId" value="<?php echo $session_user_id; ?>">
<input type="hidden" id="sessionChildId" value="<?php echo $session_child_id; ?>">
 
<!-- start hero section -->
<section class="hero">
  <div class="container">
    <div class="hero-info">
      <div class="hero-content">
        <span class="hero-tag">Parent Dashboard</span>
        <h1>Track Your Child’s <br>Growth & Development </h1>
        <p>Monitor learning milestones, physical growth, and development progress in one simple and smart dashboard.</p>
        <a href="milestone.php" class="hero-btn">
          View Milestone Tracker 
        </a>
      </div>
 
      <div class="hero-image">
        <img src="Assets/img/hero_bg.png" alt="Child development">
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
      <a href="add_child.php" class="add-child">+</a>
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
 
    <a href="milestone.php" style="text-decoration:none; color:inherit;">
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
<script src="Assets/js/dashboard.js"></script>
<script src="Assets/js/growth.js"></script>
 
    <!-- Blur Overlay -->
    <div class="blur-overlay" id="blurOverlay" onclick="closeChat()"></div>
 
    <!-- Floating Chat Button -->
    <div class="floating-chat-btn" id="floatingBtn" onclick="openChat()">
        🤖
    </div>
 
    <!-- Chat Container -->
    <div class="chat-container" id="chatContainer">
        <div class="chat-header">
            <div class="header-left">
                <div class="bot-avatar">🤖</div>
                <div class="bot-name">Spacey</div>
            </div>
            <button class="close-btn" onclick="closeChat()">✕</button>
        </div>
 
        <div class="chat-messages" id="chatMessages"></div>
 
        <div class="chat-input-container">
            <input 
                type="text" 
                class="chat-input" 
                id="userInput" 
                placeholder="Write a message..."
                onkeypress="handleKeyPress(event)"
            >
            <button class="send-btn" onclick="sendMessage()">▶</button>
        </div>
    </div>
 
 
<!-- footer include -->
<div id="footer"></div>
<!-- layout.js removed -->
<script>
        let step = 0;
        let data = {
    first_name: "",
    middle_name: "",
    last_name: "",
    email: "",
    phone: "",
    child_name: "",
    child_age: "",
    child_gender: "",
    parent_query: ""
};
function capitalizeWords(str) {
    return str
        .toLowerCase()
        .replace(/\b\w/g, char => char.toUpperCase());
}
 
 
 
        const questions = [
    "What is your first name? 😊",
    "What's your middle name? ⭐ (optional)",
    "And your last name? ✨",
    "What's your email address? 📧",
    "What's your phone number? 📱",
    "What is your child's name? 👶",   //  ADDED
    "How old is your child? 🎂",
    "What is your child's gender? (Male/Female/Other)",
    "Please write your query here! 💭"
];
 
 
        const keys = [
    "first_name",
    "middle_name",
    "last_name",
    "email",
    "phone",
    "child_name",      //  ADDED
    "child_age",
    "child_gender",
    "parent_query"
];
 
 
        function openChat() {
            const chatContainer = document.getElementById('chatContainer');
            const floatingBtn = document.getElementById('floatingBtn');
            const blurOverlay = document.getElementById('blurOverlay');
            
            chatContainer.classList.add('active');
            floatingBtn.classList.add('hidden');
            blurOverlay.classList.add('active');
            
            if (step === 0) {
                setTimeout(() => {
                    addBotMessage("Hello! 👋 I am Spacey and I will help you for understanding the application functionality. Let's start! 🌟");
                    setTimeout(() => {
                        addBotMessage(questions[0]);
                    }, 1000);
                }, 400);
            }
        }
 
        function closeChat() {
            const chatContainer = document.getElementById('chatContainer');
            const floatingBtn = document.getElementById('floatingBtn');
            const blurOverlay = document.getElementById('blurOverlay');
            
            chatContainer.classList.remove('active');
            floatingBtn.classList.remove('hidden');
            blurOverlay.classList.remove('active');
        }
 
        function addBotMessage(text) {
            const messagesDiv = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message bot-message';
            
            const time = new Date().toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            
            messageDiv.innerHTML = `
                <div class="avatar">🤖</div>
                <div>
                    <div class="bubble">
                        <div class="label">Spacey</div>
                        <div class="text">${text}</div>
                    </div>
                    <div class="timestamp">${time}</div>
                </div>
            `;
            
            messagesDiv.appendChild(messageDiv);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
 
        function addUserMessage(text) {
            const messagesDiv = document.getElementById('chatMessages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message user-message';
            
            const time = new Date().toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            
            messageDiv.innerHTML = `
                <div>
                    <div class="bubble">
                        <div class="text">${text}</div>
                    </div>
                    <div class="timestamp">${time}</div>
                </div>
            `;
            
            messagesDiv.appendChild(messageDiv);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
 
        function sendMessage() {
    const input = document.getElementById('userInput');
    const msg = input.value.trim();
 
    if (!msg) return;
    addUserMessage(msg);
 
 
    // ✅ Email validation
if (keys[step] === "email") {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(msg)) {
        addBotMessage("⚠️ Please enter a valid email address.");
        return;
    }
}
 
 
// ✅ Phone number validation
if (keys[step] === "phone") {
    if (!/^\d{10}$/.test(msg)) {
        addBotMessage("⚠️ Please enter a valid 10-digit phone number.");
        return;
    }
}
 
 
    // ✅ Age validation
    if (keys[step] === "child_age") {
        const age = parseInt(msg);
        if (isNaN(age) || age < 1 || age > 18) {
            addBotMessage("⚠️ Please enter a valid child age between 1 and 18.");
            return;
        }
    }
 
    // ✅ Gender validation
    if (keys[step] === "child_gender") {
        const valid = ["male","female","other"];
        if (!valid.includes(msg.toLowerCase())) {
            addBotMessage("⚠️ Please type Male, Female, or Other.");
            return;
        }
    }
 
// ✅ Auto-capitalize names
if (["first_name", "middle_name", "last_name", "child_name"].includes(keys[step])) {
    data[keys[step]] = capitalizeWords(msg);
} else {
    data[keys[step]] = msg;
}
 
input.value = '';
step++;
 
 
    setTimeout(() => {
        if (step < questions.length) {
            addBotMessage(questions[step]);
        } else {
            saveData();
        }
    }, 700);
}
 
 
        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }
 
       function saveData() {
    fetch('http://127.0.0.1:5000/chatbot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
 
        if (result.status === "error") {
            addBotMessage("⚠️ " + result.message);
            return;
        }
 
        // ✅ Show Gemini AI reply
        if (result.reply) {
            addBotMessage(result.reply);
        } else {
            addBotMessage("✅ Thank you! We will contact you soon.");
        }
 
    })
    .catch(error => {
        console.error(error);
        addBotMessage("⚠️ Server error. Please try again later.");
    });
}
 
</script>
 
 
 
</body>
</html>
<div>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    .fa {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      font-size: 20px;
      width: 40px;
      height: 40px;
      margin: 5px;
      text-align: center;
      text-decoration: none;
      border-radius: 50%;
      transition: transform 0.2s ease;
    }
 
    .fa:hover {
      transform: scale(1.1);
      opacity: 0.8;
    }
 
    .fa-facebook-f {
      background: #3B5998;
      color: white;
    }
 
    .fa-twitter {
      background: #55ACEE;
      color: white;
    }
 
    .fa-linkedin {
      background: #007bb5;
      color: white;
    }
 
    .fa-instagram {
      color: white;
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
    }
 
    @media only screen and (max-width: 600px) {
      .on-desktop {
        display: none;
      }
 
      .on-mobile {
        display: block;
      }
    }
 
    @media (min-width: 1025px) and (max-width: 1280px) {
      .on-desktop {
        display: block;
      }
 
      .on-mobile {
        display: none;
      }
    }
 
    .footer-widget {
      padding-left: 5px !important;
      padding-right: 5px !important;
    }
 
    .email-container {
      max-width: 600px;
      margin: 0 auto;
    }
 
    .email-label {
      display: block;
      margin-bottom: 10px;
      font-size: 18px;
      color: #333;
    }
 
    .email-form {
      display: flex;
      border: 1px solid #ccc;
      border-radius: 16px;
      padding: 6px;
      background: white;
    }
 
    .email-form input[type="email"] {
      flex: 1;
      min-width: 100px;
      padding: 16px;
      border: none;
      outline: none;
      font-size: 16px;
    }
 
    .email-form button {
      padding: 12px 20px;
      background-color: #fff;
      font-weight: bold;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 12px;
      cursor: pointer;
      transition: background 0.2s ease;
    }
 
    .email-form button:hover {
      background-color: rgb(215, 211, 211);
    }
  </style>
  </head>
 
  <body>
 
 
    <footer class="bg-white border-top pb-5">
      <div class="container" style="padding-top: 30px;">
 
        <div class="row g-5">
 
 
          <!-- Logo Section -->
          <div class="col-md-3 mb-3 mt-5">
            <a href="http://www.spacece.in">
              <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 240px; height:240px; border:none; margin-left:-80px !important; margin-top:20px !important;" />
            </a>
          </div>
 
          <!-- Contact Section -->
         <div class="col-md-3 mb-3 mt-5 text-start">
  <div class="contact-widget" style="color: black; margin-left:-40px !important; margin-top:20px !important;">
    <h5 style="font-size: 20px !important;">Contact Us</h5>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 90px !important;">
      <i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 50px !important;">
      <i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 120px !important;">
      <i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE
    </p>
    
    <p class="mb-3" style="font-size: 15px !important; margin-right: 50px !important;">
      <i class="fas fa-clock text-warning me-2"></i> Mon - Sat 8 AM - 6 PM
    </p>
  </div>
</div>
 
          <!-- Health Message + Social Media -->
           
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 class="text-warning" style="font-size:20px;  margin-left:-10px !important; margin-top:12px !important;">Still delaying treatment for your child's health concerns?</h5>
            <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Connect with India’s top doctors online, today!</p>
            <h5 style="font-size:20px">Our Socials</h6>
              <div>
                <a href="https://www.facebook.com/SpacECEIn" target="_blank" class="text-dark me-3"><i class="fa-brands fa-facebook "></i></a>
                <a href="https://twitter.com/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-twitter "></i></a>
                <a href="https://www.linkedin.com/company/spacece-co/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-linkedin "></i></a>
                <a href="https://www.instagram.com/spacece.in/" target="_blank" class="text-dark"><i class="fa-brands fa-instagram "></i></a>
              </div>
 
          </div>
 
          <!-- Newsletter Section -->
          <div class="col-md-3 mb-3 mt-5 text-start">
            <div style="margin-left: 20px;">
                <h5 style="font-size:20px !important;">Subscribe To Our Newsletter</h5>
                <p class="mb-3 fs-6" style="text-align: left; font-size:15px !important;">Subscribe to our newsletter to get updates, offers and discounts.</p>
 
                <div class="email-container">
                <label class="email-label fs-6" style="text-align: left; font-size:15px !important;" for="email">Enter your email -</label>
                <form id="sub" class="email-form">
                    <input type="email" id="email" placeholder="Email here" required />
                    <button type="submit">Submit</button>
                </form>
                </div>
 
             </div>
           </div>
        </div>
      </div>
 
    </footer>
 
    <?= isset($extra_scripts) ? $extra_scripts : null ?>
 
    <script>
      $(document).ready(function() {
        $('#sub').on('submit', function(e) {
          e.preventDefault();
          var email = $('#email').val();
 
            // ✅ Custom regex for stricter email validation
            // Previously, the form relied only on HTML5 type="email", which allowed invalid emails like 'test@mailcom'
            // Now, we use regex /^[^\s@]+@[^\s@]+\.[^\s@]+$/ to ensure:
            //   1. Email contains '@' symbol
            //   2. Email contains a dot '.' after domain (like .com, .in)
            //   3. Prevents invalid formats like 'test@mailcom' or 'test@.com'
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
 
            if (!emailPattern.test(email)) {
                swal("Error!", "Please enter a valid email address!", "error");
                return;
            }
 
          $.ajax({
            method: "POST",
            // ✅ Changed URL path
            // Previously: './common/function.php'
            // Now: '../common/function.php' to correctly point to the PHP handler from current page directory
            url: "../common/function.php",
            data: {
              subscribe: 1,
              email: email
            },
            success: function(data) {
              console.log("Server response:", data);
              handleSubscriptionResponse(data);
            },
            error: function(xhr, status, error) {
              swal("Error!", "Something went wrong. Please try again later.", "error");
            }
          });
        });
 
        function handleSubscriptionResponse(data) {
          switch (data.trim()) {
            case 'Error':
              swal("Error!", "You have already subscribed to this site!", "error");
              break;
            case 'Success':
              swal("Good job!", "You have subscribed!", "success");
              break;
            case 'Invalid':
              swal("Error!", "Please enter a valid email!", "error");
              break;
            default:
              swal("Error!", "Unexpected response from the server.", "error");
          }
        }
      });
    </script>
 
  </body>
 
  </html>
</div>
 
  <!-- Everything below stays same as index.php -->
  <?php
  // You can add the rest of your course section, cards, JS, etc. here exactly as it was
  // e.g. include 'course_section.php' if modularized
  ?>
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
 
</html>
 
 
 
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="js/scriptcall.js"></script> -->
 
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- ALightBox removed -->
	
		<script type="text/javascript">
			// ALightBox removed
		</script>
          
<script type="text/javascript">
    $(document).ready(function() {
      
        $('.progress').hide();
        // $('#progress').hide();
 
        $("#file").change(function() {
            var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'video/mp4', 'video/AVI', 'audio/mp3'];
            var file = this.files[0];
            var fileType = file.type;
            if (!allowedTypes.includes(fileType)) {
                alert('Please select a valid file (JPEG/JPG/PNG/GIF/MP4/AVI/MP3).');
                $("#file").val('');
                return false;
            }
        });
    });
 
    $(document).on("click", "#edit", function() {
        //alert("Yes");
        //$('#editModal').modal('toggle');
        $('#act_id').empty();
        $('#act_lvl').empty();
        $('#act_domain').empty();
        $('#act_obj').empty();
        $('#act_key').empty();
        $('#act_mat').empty();
        $('#act_name').empty();
        $('#act_assess').empty();
        $('#act_pro').empty();
        $('#act_ins').empty();
        $('#act_date').empty();
        var id = $(this).data('text');
        //alert(id);
        $.ajax({
            type: 'POST',
             url: '/spacece-main/milestone/api_proxy.php',
            
            data: {
                'action': 'get_tasks',
              'userId': document.getElementById('sessionUserId')?.value,
'childId': document.getElementById('sessionChildId')?.value,
                'taskId': id
            },
            success: function(resp) {
                if (typeof resp === 'string') resp = JSON.parse(resp);
                var task = (resp.data && resp.data.tasks) ? resp.data.tasks[0] : resp;
                $('#act_id').text(task.taskId        || '');
                $('#act_lvl').text(task.level        || '');
                $('#act_domain').text(task.category  || '');
                $('#act_obj').text(task.objective    || '');
                $('#act_key').text(task.keyDev       || '');
                $('#act_mat').text(task.material     || '');
                $('#act_name').text(task.task        || '');
                $('#act_assess').text(task.assessment|| '');
                $('#act_pro').text(task.process      || '');
                $('#act_ins').text(task.instructions || '');
                $('#act_date').text(task.date        || '');
            },
            error: function() { alert('Failed to load task details.'); }
        });
    });
 
    
    $(document).on("click", "#upload", function() {
        var cat_id= $(this).data('text');
        var pl_id=$(this).data('playlist');
        var id =    $(this).data('text');
 
    $('#uploadVideo').on('submit', function(event) {
 
       
        event.preventDefault();
 
        var fd = new FormData();
        var file_data = $('input[type="file"]').prop('files')[0];
        //alert(file_data);
        var title = $('#title').val();
        var summary = $('#summary').val();
       
        fd.append("file", file_data);
        fd.append("title", title);
        fd.append("summary", summary);
        fd.append("id", id);
        fd.append("pl_id", pl_id);
        $('#exampleModal').modal('hide');
        $('.progress').show();
 
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = parseInt(((evt.loaded / evt.total) * 100));
                        $("#progress-bar").width(percentComplete + '%');
                        $("#progress-bar").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'Youtube/index.php',
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#progress-bar").width('0%');
                $('#loader-icon').show();
                $('#exampleModal').modal('hide');
                $("#exampleModal").hide();
                $("#exampleModal").removeClass("in");
                $(".modal-backdrop").remove();
            },
            error: function() {
                $('#loader-icon').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp) {
                alert(resp);
                $('.progress').hide();
                if (resp == 'ok') {
                    // $('#uploadForm')[0].reset();
                    // $('#loader-icon').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
 
                } else if (resp == 'err') {
                    //  $('#loader-icon').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                }
            }
        });
    });
 
});
 
 
    $('#playlist').on('click', function() {
 
        $('#exampleModal').modal('toggle');
    });
 
 
    $('#AddDescription').on('submit', function(event) {
 
        event.preventDefault();
        var title = $('#title').val();
        var summary = $('#summary').val();
        $.ajax({
            type: 'POST',
            url: 'Youtube/data.php',
            data: {
                title: title,
                summary: summary
 
            },
            success: function(data) {
                alert(data);
            }
 
        });
 
    });
</script>
<script>
 
// // Video/playlist features removed
//                 $(document).ready(function() {
//     var currentPage = 1;
//     var totalPages = 0;
 
//     function loadTable(page) {
//         $.ajax({
//             type: 'POST',
//             url: '/spacece-main/milestone/api_proxy.php',
//             data: {
//                 'action': 'get_tasks',
//                'userId': document.getElementById('sessionUserId')?.value,
// 'childId': document.getElementById('sessionChildId')?.value,
//                 'page': page
//             },
//             success: function(data) {
//                 // Parse the response data
//                 data = JSON.parse(data);
//                 $('#tablebody').html(data.records); // Populate table body
//                 totalPages = data.totalPages; // Update total pages
//                 $('#currentPage').text('Page ' + currentPage); // Display current page
//                 $('#prevPage').prop('disabled', currentPage <= 1); // Disable "Previous" button on first page
//                 $('#nextPage').prop('disabled', currentPage >= totalPages); // Disable "Next" button on last page
//             }
//         });
//     }
 
//     loadTable(currentPage); // Load first page initially
 
$(document).ready(function() {
    var currentPage = 1;
    var totalPages = 0;

    function loadTable(page) {
        // ✅ FIX 2: Guard — don't fire if user is not logged in
        var uid = document.getElementById('sessionUserId')?.value;
        var cid = document.getElementById('sessionChildId')?.value;
        if (!uid || uid === '0') {
            console.warn('[loadTable] No userId — skipping API call');
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/spacece-main/milestone/api_proxy.php',
         
            data: {
                'action':  'get_tasks',
                'userId':  uid,
                'childId': cid,
                'page':    page
            },
            success: function(data) {
                if (typeof data === 'string') data = JSON.parse(data);
                $('#tablebody').html(data.records);
                totalPages = data.totalPages;
                $('#currentPage').text('Page ' + currentPage);
                $('#prevPage').prop('disabled', currentPage <= 1);
                $('#nextPage').prop('disabled', currentPage >= totalPages);
            },
            // ✅ FIX 2: Added error handler so failures show clearly
            error: function(xhr) {
                console.warn('[loadTable] API error:', xhr.status, xhr.responseText);
            }
        });
    }

    //loadTable(currentPage);

    $('#prevPage').click(function() {
        if (currentPage > 1) {
            currentPage--;
            loadTable(currentPage);
        }
    });
 
    $('#nextPage').click(function() {
        if (currentPage < totalPages) {
            currentPage++;
            loadTable(currentPage);
        }
    });
});
 
 
                
  </script>