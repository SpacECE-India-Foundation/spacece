$(document).ready(function(){	
	
	var activityData = $('#activityList').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"responsive": true,
		"order":[],
		"ajax":{
			url:"action.php",
			type:"POST",
			data:{action:'listActivity'},
			dataType:"json"
		},
		columnDefs: [
			{
								targets: [0,1,2,3,4,5,6,7,8,9,10],
										createdCell: function(cell, cellData, rowData, rowIndex, colIndex) {
										
											var $cell = $(cell)
											
											if (cellData.length > 25) {
												
												$(cell).contents().wrapAll("<div class='content'></div>");
											//get the new class
											var $content = $cell.find(".content");
											
											
											$content.css({
												"height": "20px",
												"overflow": "hidden"
											})
											
											$(cell).append($("<button class='read'>Read more </button>"));
										
											
										}
											
											$btn = $(cell).find("button");  
											//store flag
											$cell.data("isLess", true);
											//eval click on button
											$btn.click(function() {
											  //create local variable and assign prev. stored flag
											  var isLess = $cell.data("isLess");
											  //ternary check if this flag is set and manipulte/reverse button
											  $content.css("height", isLess ? "auto" : "20px")
											  $(this).text(isLess ? 'Read Less' : 'Read more')
											  //invert flag
											  $cell.data("isLess", !isLess)
											})
									  }
								}
					  
					]
		
	});		
	$('#addActivity').click(function(){
		$('#activityModal').modal('show');
		$('#activityForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Employee");
		$('#action').val('addEmployee');
		$('#save').val('Add');
	});		
	$("#activityList").on('click', '.update', function(){
		
		var activity_no = $(this).attr("id");
	
		var action = 'getActivity';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{activity_no:activity_no, action:action},
			dataType:"json",
			success:function(data){
				$('#activityModal').modal('show');
				 $('#activity_name').val(data.activity_name);
				 $('#activity_level').val(data.activity_level);
				$('#activity_dev_domain').val(data.activity_dev_domain);
				$('#activity_objectives').val(data.activity_objectives);				
				$('#activity_key_dev').val(data.activity_key_dev);
				$('#activity_material').val(data.activity_material);	
				$('#activity_assessment').val(data.activity_assessment);
				$('#activity_process').val(data.activity_process);
				$('#activity_instructions').val(data.activity_instructions);
				$('#status').val(data.status);				
				$('#activity_date').val(data.activity_date);
				$('#playlist_id').val(data.playlist_id);	
				$('#playlist_descr').val(data.playlist_descr);
				$('#playlist_name').val(data.playlist_name);
				$('#activity_no').val(data.activity_no);
				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Activity");
				$('#action').val('updateActivity');
				$('#save').val('Save');
			}
		})
	});
	$("#activityModal").on('submit','#activityForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#activityForm')[0].reset();
				$('#activityModal').modal('hide');				
				$('#save').attr('disabled', false);
				activityData.ajax.reload();
			}
		})
	});		
	$("#activityList").on('click', '.delete', function(){
		var activity_no = $(this).attr("id");
			
		var action = "activityDelete";
		if(confirm("Are you sure you want to delete this Activity?")) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{activity_no:activity_no, action:action},
				success:function(data) {					
					activityData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
});