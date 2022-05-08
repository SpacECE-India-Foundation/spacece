 <nav class="navbar  fixed-top bg-dark flex-md-nowrap p-0 shadow" style="color:orange">
 	<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/libforsmall">Lib For Smalls</a>
	 <li><a href="./index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
 	<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
 	<ul class="navbar-nav px-3">
 		<li class="nav-item text-nowrap">
 			<?php
				if (isset($_SESSION['uid'])) {
				?>
 				<a class="nav-link" href="../../../spacece_auth/logout.php">Sign out</a>
 				<?php
				} else {
					$uriAr = explode("/", $_SERVER['REQUEST_URI']);
					$page = end($uriAr);
					if ($page === "login.php") {
					?>
 					<!-- <a class="nav-link" href="../admin/register.php">Register</a> -->
 				<?php
					} else {
					?>
 					<a class="nav-link" href="../../../spacece_auth/login.php">Login</a>
 			<?php
					}
				}

				?>

 		</li>
 	</ul>
 </nav>