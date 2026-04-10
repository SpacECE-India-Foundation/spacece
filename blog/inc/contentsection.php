	<!-- Projects Section -->
	
	<div class="container pt">
		<div class="row mt centered">
<?php /*MenuITEM: show php code */
    $query = "SELECT * FROM tb_menu WHERE status=1";
    $menu = $db->select($query);
    if($menu){
        while($result = $menu->fetch_assoc()) {
?>
			<div class="col-lg-4">
				<a class="zoom green" href="page.php?id=<?php echo $result['id']; ?>"><img class="img-responsive" src="assets/img/portfolio/<?php echo $result['image']; ?>" alt="no-image" /></a>
				<p><?php echo $result['name']; ?></p>
			</div>
<?php  } } ?>
			<div class="col-lg-4">
				<h3>Blogs for Childreans</h3>
				<hr>
				<p>
					Read blogs for children activity and food habits <a href="about.php">See More</a>
				</p>
			</div>

		</div><!-- /row -->

	</div><!-- /container -->



 

