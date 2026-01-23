<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SpaceECE Footer</title>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

html, body {
    width: 100%;
    overflow-x: hidden;   /* 🚫 horizontal scroll killer */
}

.social_icon {
    text-align: center;
}

footer{
  background:#fff;
  border-top:2px solid #e6e6e6;
  padding:40px 0  60px 0px;
}
footer .row{
  display: flex;
  flex-wrap: wrap;
  gap: 40px;                 /* 🔥 Proper equal spacing */
  justify-content: flex-start;
}
footer .col-md-3{
  flex: 1 1 calc(25% - 40px); /* 🔑 gap compensate */
  max-width: calc(25% - 40px);
}
footer img{
  max-width:100%;
  width: 100px;
  display: block;
  margin: auto;
}
.text-warning {
    color: #ff9800 !important;
}

.fa-facebook-f ,.fa-twitter ,.fa-linkedin ,.fa-instagram{
    background: #ff9800 !important;
}
footer h5{
  font-size:20px;
  margin-bottom:12px;
  text-align: center;
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
footer p{
  font-size:15px;
  line-height:1.7;
  text-align: center;
}
.text-warning{color:#f4b400;}
.contact-widget p{
  display:flex;
  gap:10px;
  align-items:center;
  margin-bottom: 5px;
}

/* Social icons */
.fa-brands{
  width:30px;
  height:30px;
  display:inline-flex;
  justify-content:center;
  align-items:center;
  border-radius:20%;
  font-size:18px;
  margin:4px;
  color:#fff;
  transition:0.2s;
}
.fa-facebook-f{background:#1877f2;}
.fa-twitter{background:#1da1f2;}
.fa-linkedin{background:#0a66c2;}
.fa-instagram{
  background:radial-gradient(circle at 30% 107%,
  #fdf497 0%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
}
.fa-brands:hover{transform:scale(1.1);}

/* Newsletter */


/* ===============================
   NEWSLETTER SEPARATE FORM
================================ */

.newsletter-form{
    display:flex;
    flex-direction:column;
    gap:12px;                /* 🔑 input & button ke beech space */
}

/* Email input */
.newsletter-form input{
    width:100%;
    padding:16px 18px;
    font-size:15px;
    border:1px solid #d0d0d0;
    border-radius:24px;
    outline:none;
}

/* Submit button */
.newsletter-form button{
    width:100%;
    padding:14px;
    font-size:15px;
    font-weight:600;
    border:none;
    border-radius:24px;
    background:#f5f5f5;
    cursor:pointer;
    transition:all 0.2s ease;
}

.newsletter-form button:hover{
    background:#ececec;
}




/* Responsive */
@media(max-width:1024px){
  footer .col-md-3{flex:0 0 50%;max-width:50%;margin-bottom:30px;}
}
@media(max-width:768px){
  footer{text-align:center;}
  footer .col-md-3{flex:0 0 100%;max-width:100%;}
  .contact-widget p{justify-content:center;}
  .email-form{flex-direction:column;}
  .email-form button{width:100%;}
}

/* ===============================
   GLOBAL CONTAINER FIX
================================ */
.container{
    width:100%;
    max-width:1200px;          /* 🔒 design lock */
    margin-left:auto;
    margin-right:auto;
    padding-left:20px;
    padding-right:20px;
    box-sizing:border-box;
}

/* ===============================
   LARGE DESKTOP (≥1440px)
================================ */
@media (min-width:1440px){
    .container{
        max-width:1320px;
    }
}

/* ===============================
   EXTRA LARGE / 4K (≥1800px)
================================ */
@media (min-width:1800px){
    .container{
        max-width:1600px;
    }
}

/* ===============================
   LAPTOP / TABLET (≤1024px)
================================ */
@media (max-width:1024px){
    .container{
        max-width:960px;
        padding-left:16px;
        padding-right:16px;
    }
}

/* ===============================
   TABLET (≤768px)
================================ */
@media (max-width:768px){
    .container{
        max-width:720px;
        padding-left:16px;
        padding-right:16px;
    }
}

/* ===============================
   MOBILE (≤600px)
================================ */
@media (max-width:600px){
    .container{
        max-width:100%;
        padding-left:14px;
        padding-right:14px;
    }
}

/* ===============================
   SMALL MOBILE (≤360px)
================================ */
@media (max-width:360px){
    .container{
        padding-left:12px;
        padding-right:12px;
    }
}

</style>
</head>

<body>

<footer>
  <div class="container">
    <div class="row">

      <!-- Logo -->
      <div class="col-md-3">
        <a href="http://www.spacece.in">
          <img src="../Assets/img/SpacECELogo.jpg" alt="SpaceECE Logo">
        </a>
        <div class="social_icon">
          <h5>Our Socials</h5>
          <a href="https://www.facebook.com/SpacECEIn" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="https://twitter.com/" target="_blank"><i class="fa-brands fa-twitter"></i></a>
          <a href="https://www.linkedin.com/company/spacece-co/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
          <a href="https://www.instagram.com/spacece.in/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
        </div>
      </div>

      <!-- Contact -->
      <div class="col-md-3">
        <h5>Contact Us</h5>
        <div class="contact-widget">
          <p><i class="fa-solid fa-phone text-warning"></i> +91 90963 05648</p>
          <p><i class="fa-solid fa-envelope text-warning"></i> events@spaceece.co</p>
          <p><i class="fa-solid fa-location-dot text-warning"></i> SPACE-ECE</p>
          <p><i class="fa-solid fa-clock text-warning"></i> Mon-Sat 8 AM – 6 PM</p>
        </div>
      </div>

      <!-- Message + Social -->
      <div class="col-md-3">
        <h5 class="text-warning">
          Still delaying treatment for your child’s health concerns?
        </h5>
        <p>Connect with India’s top doctors online, today!</p>
      </div>

      <!-- Newsletter -->
      <div class="col-md-3">
        <h5>Newsletter</h5>
        <p>Get updates, offers and discounts.</p>

        <form class="newsletter-form">
          <input 
            type="email" 
            placeholder="Email here" 
            required
          >
          <button type="submit">Submit</button>
        </form>
      </div>


    </div>
  </div>
</footer>

<script>
const BASE_URL="https://hustle-7c68d043.mileswebhosting.com/spacece/api";

function isValidEmail(email){
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

document.getElementById("sub").addEventListener("submit",async e=>{
  e.preventDefault();
  const email=document.getElementById("email").value.trim();
  const btn=document.getElementById("subscribeBtn");

  if(!isValidEmail(email)){
    swal("Error","Enter valid email","error");
    return;
  }

  btn.disabled=true;
  btn.innerText="Submitting...";

  try{
    const res=await fetch(`${BASE_URL}/subscribeNewsletter`,{
      method:"POST",
      headers:{"Content-Type":"application/json"},
      body:JSON.stringify({email})
    });
    const data=await res.json();
    swal(data.status?"Success":"Error",data.message,"info");
    if(data.status) document.getElementById("email").value="";
  }catch{
    swal("Error","Server error","error");
  }
  btn.disabled=false;
  btn.innerText="Submit";
});
</script>

</body>
</html>