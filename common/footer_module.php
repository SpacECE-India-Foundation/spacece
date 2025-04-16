<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<!--bug id  0000115 -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
  .fa {
    padding: 2px;
    font-size: 30px;
    width: 30px;
    text-align: center;
    text-decoration: none;
    margin: 5px 2px;
    border-radius: 20%;
  }

  .fa:hover {
    opacity: 0.7;
  }

  .fa-facebook-f {
    background: #3B5998;
    color: white;
  }

  .fa-twitter {
    background: #55ACEE;
    color: white;
  }

  .fa-google {
    background: #dd4b39;
    color: white;
  }

  .fa-linkedin {
    background: #007bb5;
    color: white;
  }

  .fa-youtube {
    background: #bb0000;
    color: white;
  }

  .fa-instagram {
    display: inline-flex;
    text-align: center;
    border-radius: 20%;
    color: #fff;
    width: 30px;
    height: 35px;
    font-size: 30px;
    /*line-height: 20px;
  vertical-align: middle;*/
    background: #d6249f;
    background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
    box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
    flex-direction: column;
  }

  .fa-pinterest {
    background: #cb2027;
    color: white;
  }

  .fa-telegram {
    background: #125688;
    color: white;
  }

  .fa-snapchat-ghost {
    background: #fffc00;
    color: white;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
  }

  .fa-skype {
    background: #00aff0;
    color: white;
  }

  .fa-android {
    background: #a4c639;
    color: white;
  }

  .fa-dribbble {
    background: #ea4c89;
    color: white;
  }

  .fa-vimeo {
    background: #45bbff;
    color: white;
  }

  .fa-tumblr {
    background: #2c4762;
    color: white;
  }

  .fa-vine {
    background: #00b489;
    color: white;
  }

  .fa-foursquare {
    background: #45bbff;
    color: white;
  }

  .fa-stumbleupon {
    background: #eb4924;
    color: white;
  }

  .fa-flickr {
    background: #f40083;
    color: white;
  }

  .fa-yahoo {
    background: #430297;
    color: white;
  }

  .fa-soundcloud {
    background: #ff5500;
    color: white;
  }

  .fa-reddit {
    background: #ff5700;
    color: white;
  }

  .fa-rss {
    background: #ff6600;
    color: white;
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
</style>
</head>
<div class="container">
  <footer class="footer-section set-bg" style="
        background-color: orange;
        border-collapse: collapse;
        border: 2px solid navy;
        opacity: 0.9;
        padding: 30px 30px;
      ">

    <div class="row">
      <div class="col-lg-3 footer-widget ">
        <a href="http://www.spacece.in"><img src="<?= isset($module_logo) ? $module_logo : './img/logo/SpacECELogo.jpg' ?>" class="img img-fluid img-thumbnail img-circle" alt="" style="width: 150px" /></a><a href="./index.php">

        </a>

        <div class="social">
          <a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
          <a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
          <a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>
        </div>
      </div>

      <div class="col-lg-3  footer-widget">
        <p style="color: black">
          Still delaying your child's health concerns ?
        </p>
        <p style="color: black">Connect with India's top doctors online</p>
      </div>
      <div class="col-lg-3 footer-widget" style="text-align: justify;">
        <div class="contact-widget" style="color: black;">
          <h5 class="fw-title" style="color: black; font-size: 16px;">CONTACT US</h5>
          <div style="display: flex; flex-direction: column; justify-content: space-around;">
            <p style="margin: 2px 0; font-size: 14px;">
              <!-- <a href="http://www.spacece.in/" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;"> -->
              <a href="https://maps.app.goo.gl/YDb6ZAsN4vQ1KWZE8" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                <i class="fa fa-map-marker" style="margin-right: 10px; font-size: 18px;"></i>
                SPACE-ECE
              </a>
            </p>
            <p style="margin: 5px 0; font-size: 14px;">
              <a href="tel:+919096305648" target="_blank" rel="noopener" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                <i class="fa fa-phone" style="margin-right: 10px; font-size: 18px;color: black;"></i>
                +91 90963 05648
              </a>
            </p>
            <p style="margin: 5px 0; font-size: 14px;">
              <a href="mailto:events@spacece.co" target="_blank" rel="noopener" style="display: flex; align-items: center; color: black; text-decoration: none; font-size: 18px;">
                <i class="fa fa-envelope" style="margin-right: 10px; font-size: 18px;color: black;"></i>
                events@spacece.co
              </a>
            </p>
            <p style="margin: 5px 0; font-size: 18px; color: black;">
              <i class="fa fa-clock-o" style="margin-right: 10px; font-size: 18px;"></i>
              Mon - Sat, 8AM - 6PM
            </p>
          </div>
        </div>
      </div>




      <div class="col-lg-3  footer-widget">
        <div class="newslatter-widget">
          <h5 class="fw-title" style="color: black; text-align: center">
            NEWSLETTER
          </h5>
          <p style="color: black">
            Subscribe your email to get the latest news and new offer also
            discount
          </p>
          <form class="footer-newslatter-form" id="sub" name="sub" method="POST" style="display: flex; gap: 5px; align-items: center;">
          <input type="email" name="email" id="email" placeholder="Email address" required style="flex: 1; padding: 5px; height: 50px;" />
          <button type="submit" style="padding: 5px 5px; height: 50px; background: white; border: 1px solid black; cursor: pointer;">
          <i class="fa fa-send"></i>
          </button>
          </form>

        </div>
      </div>
    </div>

</div>
</footer>
<p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px">
  <span style="font-size: 20px"><span class="color_15">&copy;2021 by spaceECE INDIA FOUNDATION</span></span>
</p>



<?= isset($extra_scripts) ? $extra_scripts : null ?>

</body>
<script>
  $(document).ready(function() {
    $('#sub').on('submit', function(e) {
      e.preventDefault();
      var email = $('#email').val();
      
      $.ajax({
        method: "POST",
        url: "./common/function.php",
        data: {
          subscribe: 1,
          email: email
        },
        success: function(data) {
          console.log("Server response:", data); // Log the server response for debugging
          handleSubscriptionResponse(data);
        },
        error: function(xhr, status, error) {
          swal("Error!", "Something went wrong. Please try again later.", "error");
        }
      });
    });

    function handleSubscriptionResponse(data) {
      switch(data.trim()) { // Use trim() to remove any extra whitespace
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


</html>
