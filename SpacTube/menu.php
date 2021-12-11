<?php
    $page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    
?>

<ul class="nav justify-content-center bg-dark" >
                <li class="nav-item">
                    <div class="nav-link heading" style="color:white;">SpacTube</div>
                </li>
            </ul><br>
            	<button <?php if($page != 'view'){ ?> onclick="window.open('view.php', '_self')" <?php } else {} ?> name = "free" class="btn-btn" <?php if($page == 'view'){ ?> style="background-color:#DCDCDC;" <?php } else { ?> style="background-color:orange;" <?php } ?> ><h6>Free Section</h6></button>

            	<button <?php if($page != 'view1'){ ?> onclick="window.open('view1.php', '_self')" <?php } else {} ?> name = "paid" class="btn-btn" <?php if($page == 'view1'){ ?> style="background-color:#DCDCDC;" <?php } else { ?> style="background-color:orange;" <?php } ?> ><h6>Paid Section</h6></button>

                <button <?php if($page != 'trending'){ ?> onclick="window.open('trending.php', '_self')" <?php } else {} ?> name = "trending" class="btn-btn" <?php if($page == 'trending'){ ?> style="background-color:#DCDCDC;" <?php } else { ?> style="background-color:orange;" <?php } ?> ><h6>Trending Section</h6></button>
            
                <!-- <button onclick="window.open('https:/www.spacece.co/about-us', '_self')" name = "about" class="btn-btn"style="background-color:orange;"><h6>About Us</h6></button><button onclick="window.open('https:/www.spacece.co/about-us', '_self')" name = "about" class="btn-btn"style="background-color:orange;"><h6>About Us</h6></button> -->
                <button onclick="window.open('../about.php', '_self')" name = "about" class="btn-btn"style="background-color:orange;"><h6>About Us</h6></button>
                <button onclick="window.open('https:/api.whatsapp.com/send?phone=+919096305648')" name = "contact" class="btn-btn"style="background-color:orange;"><h6>Contact Us</h6></button>
