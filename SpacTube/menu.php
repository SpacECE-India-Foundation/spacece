<?php
$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

?>

<ul class="nav justify-content-center bg-dark">
</ul><br>
<button <?php if ($page != 'view') { ?> onclick="window.location.href = 'view.php';" <?php } else {
                                                                                    } ?> name="free" class="btn-btn" <?php if ($page == 'view') { ?> style="background-color:#DCDCDC;" <?php } else { ?> style="background-color:orange;" <?php } ?>>
    <h6>Free Section</h6>
</button>

<button <?php if ($page != 'view1') { ?> onclick="window.location.href = 'view1.php';" <?php } else {
                                                                                    } ?> name="paid" class="btn-btn" <?php if ($page == 'view1') { ?> style="background-color:#DCDCDC;" <?php } else { ?> style="background-color:orange;" <?php } ?>>
    <h6>Paid Section</h6>
</button>

<button <?php if ($page != 'trending') { ?> onclick="window.location.href = 'trending.php';" <?php } else {
                                                                                            } ?> name="trending" class="btn-btn" <?php if ($page == 'trending') { ?> style="background-color:#DCDCDC;" <?php } else { ?> style="background-color:orange;" <?php } ?>>
    <h6>Trending Section</h6>
</button>

<button <?php if ($page != 'audio_book') { ?> onclick="window.location.href = 'audio_book.php';" <?php } else {
                                                                                            } ?> name="audio_book" class="btn-btn" <?php if ($page == 'audio_book') { ?> style="background-color:#DCDCDC;" <?php } else { ?> style="background-color:orange;" <?php } ?>>
    <h6>Audio book Section</h6>
</button>
<!-- <button onclick="window.open('https:/www.spacece.co/about-us', '_self')" name = "about" class="btn-btn"style="background-color:orange;"><h6>About Us</h6></button><button onclick="window.open('https:/www.spacece.co/about-us', '_self')" name = "about" class="btn-btn"style="background-color:orange;"><h6>About Us</h6></button> -->
<button onclick="window.location.href = '../about.php';" name="about" class="btn-btn" style="background-color:orange;">
    <h6>About Us</h6>
</button>
<button onclick="window.location.href = 'https://api.whatsapp.com/send?phone=+919096305648';" name="contact" class="btn-btn" style="background-color:orange;">
    <h6>Contact Us</h6>
</button>
<button onclick="window.location.href = 'https://www.instamojo.com/@spacece/l3a3b190992504d639f4fb6fc9bfc40fe/';" type="button" class="btn-btn" style="background-color:orange;">
    <h6>Subscribe</h6>
</button>