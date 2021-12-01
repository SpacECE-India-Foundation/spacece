<?php


include_once('includes/header.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
</head>

<body>
	<div id="n_id"></div>
	<div id="n_text"></div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var base_url = '<?php echo BASE_URL; ?>';
		var baseUrl = (window.location).href;
		$('#n_id').empty();
		$('#n_text').empty();

		//var id = GetUrlKeyValue("id", false, location.href);
		var query = window.location.search.substring(1);
		var vars = query.split("=");
		var id = vars[1];
		$.ajax({
			method: "POST",
			data: {
				id: id
			},
			url: base_url + "/function.php?getNotification",
			success: function(data) {

				var data1 = JSON.parse(data);
				$('#n_id').append(data1[0].notification_id);
				$('#n_text').append(data1[0].notification_subject);



			}
		})
	});
</script>