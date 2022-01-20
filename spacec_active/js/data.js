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
		"columnDefs":[
			{
				"targets":[0,12,13,14],
				"orderable":false,
			},
		],
		"pageLength": 10
	});		
	$('#addActivity').click(function(){
		$('#activityModal').modal('show');
		$('#activityForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Employee");
		$('#action').val('addEmployee');
		$('#save').val('Add');
	});		
	$("#activityList").on('click', '.update', function(){
		var empId = $(this).attr("id");
		var action = 'getActivity';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{empId:empId, action:action},
			dataType:"json",
			success:function(data){
				$('#activityModal').modal('show');
				$('#empId').val(data.id);
				$('#empName').val(data.name);
				$('#empAge').val(data.age);
				$('#empSkills').val(data.skills);				
				$('#address').val(data.address);
				$('#designation').val(data.designation);	
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Employee");
				$('#action').val('updateEmployee');
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
		var activity_no = $(this).attr("activity_no");		
		var action = "activityDelete";
		if(confirm("Are you sure you want to delete this employee?")) {
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