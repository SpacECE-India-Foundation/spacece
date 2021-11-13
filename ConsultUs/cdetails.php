<?php include('indexDB.php') ?>
<?php error_reporting(0); 
$ref = $_GET['user']; 
$cat = $_GET['category']; ?>
<html>
    <head>
        <title>Appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Styles.css">

    </head>
    <body>

	<!-- Header section -->
	<header class="header-section" style="background-color:orange;">
		<div class="header-top" style = "position:absolute; left:850px; top:15px;">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-12 text-lg-right header-top-right">
						<div class="top-social">
							
							<a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook"></i></a>
							<a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
							<a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
							<a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>
							
						</div>

					</div>
				</div>
			</div>
		</div>
		<div >
			<div class="row">
				<div >
					<div >
						
						<div style="padding: -30px 20px; " >
							
							<i class="fa fa-bars"></i>
							

						</div>
						<ul class="main-menu" style="margin-left: 60px;">
							<img src="img/space.jpg" alt="" style="width:6%; ">
							<li><a href="index.html" style="color:black"><i class="fa fa-home"></i>HOME</a></li>
							<li><a href="about.html" style="color:black"><i class="fa fa-users"></i> ABOUT US</a></li>
							<li><a href="contact.html" style="color:black"><i class="fa fa-envelope" style="color:black;"></i> CONTACT US</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>

                
        <! ... main section starts...>
        <div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 0%, #ffffff 100%);">
            <div class="wrapper ">
                <br><br><br><br><br><h2 ><center><u> CONSULTANT DETAIL</u></center></h2>
                <br>
       <!.... BUTTON TO ADD consultant...>
                 <a href="<?php echo SITEURL;?>chatbot/room.php?roomname=global1" class="btn-primary" style="color:black;background-color:orange;float:right;">CHAT GLOBAL</a><br><br>
                 <br>
                 <br>

                <table class="tb-full">
                    <tr>
                        <th>S.NO.:</th>
                        <th>IMAGE:</th>
                        <th>FULL NAME:</th>
                        <th>CATEGORY:</th>
                        <th>OFFICE:</th>
                        <th>LANGUAGE:</th>
                        <th>TIME(from):</th>
                        <th>TIME(to):</th>
                    </tr>
                        <?php
                    // showing admin added from database
                    if($cat == "all")
                    {
                    $sql = "SELECT * FROM `consultant` ";
                    $res = mysqli_query($conn,$sql);


                    //checking whether query is excuted or not
                    if($res){
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res);
                        $sno =1;
                        if($count>0){
                            // we have data in database
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // extracting values from dATABASE

                                $id=$row['c_id'];
                                $full_name=$row['name'];
                                $category=$row['category'];
                                $office_location=$row['office'];
                                $stime=$row['stime'];
                                $ctime=$row['ctime'];
                                $lang=$row['lang'];
                                $img = $row['img'];
                                $uid= rand(0,1000000);
                                

                                
                                // displaying value in table
                        ?>
                     
                        <tr>
                        <td><?php echo $sno++; ?></td>
                     <td><img src="<?php echo $img ?>" width="100" height="100"></td>
                       <td><?php echo $full_name; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $office_location; ?></td>
                        <td><?php echo $lang; ?></td>
                        <td><?php echo $ctime; ?></td>
                        <td><?php echo $stime; ?></td>
                        
                    </tr>
                   
                    <?php
                    /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/
                   
                     }
                    }
                    }
                }
                else{
                    ?>

                    <?php

                    
                    // showing admin added from database
                    
                    $sql = "SELECT * FROM `consultant` WHERE `category`='$cat' order by `name` ";
                    $res = mysqli_query($conn,$sql);


                    //checking whether query is excuted or not
                    if($res){
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res);
                        $sno =1;
                        if($count>0){
                            // we have data in database
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // extracting values from dATABASE

                                $id=$row['c_id'];
                                $full_name=$row['name'];
                                $category=$row['category'];
                                $office_location=$row['office'];
                                $stime=$row['stime'];
                                $ctime=$row['ctime'];
                                $img = $row['img'];
                                $lang=$row['lang'];
                                $uid= rand(0,1000000);
                                

                                
                                // displaying value in table
                        ?>
                     
                        <tr>
                        <td><?php echo $sno++; ?></td>
                           <td><img src="<?php echo $img ?>" width="100" height="100"></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $office_location; ?></td>
                        <td><?php echo $lang; ?></td>
                        <td><?php echo $ctime; ?></td>
                        <td><?php echo $stime; ?></td>
                        
                    </tr>
                   
                    <?php
                    /*<a href="<?php echo SITEURL;?>chatbot/room.php?roomname=uid<?php echo $uid;?>" class="btn-primary">CHAT</a>*/
                   
                     }
                    }
                    }
                }
                    ?>

                </table>     
            </div>
        </div>
        <!... main section ends....>
        <! ... end section starts...>
         <div class="footer text-centre" style="background-color:orange;">
            <div class="wrapper">
                 <p class="text-center">DEVELOPED BY:<a href="#">&nbspyashasvi pundeer</a></p>
            </div>
         </div>
        <!... end section ends....>
    </body>


</html>