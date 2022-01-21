<?php

include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<title>webdamn.com : Datatables Add Edit Delete with Ajax, PHP & MySQL</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/data.js"></script>	
<style>
.read{
	background-color: orange;
	border-radius: 5px;
}
	</style>
<div class=" contact">	
	
	
		<div class="panel-heading">
		
					<!-- <button type="button" name="add" id="addEmployee" class="btn btn-success btn-xs">Add Employee</button> -->
		
		</div>
		<table id="activityList" class="table table-bordered table-striped ">
			<thead>
				<tr>
					<th>Activity Id</th>
					<th>Activity name</th>
					<th>Activity level</th>					
					<th>Activity dev domain</th>
					<th>Activity objectives</th>
					<th>Activity key dev</th>
					<th>Activity material</th>
					<th>Activity assessment</th>
					<th>Activity process</th>					
					<th >Activity instructions</th>
					<th>Status</th>
					<th>Activity date</th>					
					<th>Playlist id</th>
					<th>Playlist descr</th>	
					<th>Playlist name</th>	
					<th></th>	
									
				</tr>
			</thead>
		</table>
	</div>
	<div id="activityModal" class="modal fade">
    	<div class="modal-dialog modal-lg">
    		<form method="post" id="activityForm">
    			<div class="modal-content">
    				<div class="modal-header">
					<div class="mr-2" ><h4 class="modal-title"><i class="fa fa-plus"></i> Edit Activity</h4></div>
					<br>
    					<button type="button" class="close" data-dismiss="modal">&times;</button>	
    				</div>
    				<div class="modal-body">
						<div class="row">
						<div class="col-sm-6">
						<div class="form-group">
							<label for="activity_name" class="control-label">Name</label>
							<input type="text" class="form-control" id="activity_name" name="activity_name" placeholder="Activity Name" required>			
						</div>
						<div class="form-group">
						<lable for ="activity_level">Activity Level : </lable>
					<select class="form-control" id="activity_level" name="activity_level" required>
						<option value="">Select</option>
						<option value="1">Level 1</option>
						<option value="2">Level 2</option>
						<option value="3">Level 3</option>
						<option value="4">Level 4</option>
					</select>						
						</div>	   	
						<div class="form-group">
							<label for="activity_dev_domain" class="control-label">Activity Developing Domain  : </label>							
							
       					 <input type="text" name="activity_dev_domain" class="form-control" id="activity_dev_domain" placeholder="Activity Developing Domain" required>
						</div>	 
						<div class="form-group">
							<label for="activity_objectives" class="control-label">Activity objectives  :</label>							
							<textarea name="activity_objectives" class="form-control" id="activity_objectives" cols="30" rows="3" placeholder="Activity objectives" required></textarea>							
						</div>
						<div class="form-group">
							<label for="activity_process" class="control-label">Activity process :</label>							
							<textarea name="activity_process" class="form-control" id="activity_process" cols="30" rows="3" placeholder="Activity process" required></textarea>		
						</div>	
						<div class="form-group">
							<label for="playlist_name" class="control-label">Playlist  Name : </label>							
							<input type="text" name="playlist_name" class="form-control" id="playlist_name" placeholder="Youtube Playlist  Name" readonly>							
						</div>
						<div class="form-group">
						<label for="activity_key_dev" class="control-label">Activity Key Objectives</label>
							<input type="text" name="activity_key_dev" class="form-control" id="activity_key_dev" placeholder="Activity Key Objectives" required>			
						</div>	
						</div>
						<div class="col-sm-6">
						<div class="form-group">
							<label for="activity_material" class="control-label">Activity material</label>
							<input type="text" name="activity_material" class="form-control" id="activity_material" placeholder="Activity material" required>			
						</div>
						<div class="form-group">
							<label for="activity_assessment" class="control-label">Activity Assesment :</label>							
							<textarea name="activity_assessment" class="form-control" id="activity_assessment" placeholder="Activity Assesment" cols="30" rows="3" required></textarea>							
						</div>
						<div class="form-group">
							<label for="activity_instructions" class="control-label">Activity Instructions :</label>							
							<textarea name="activity_instructions" class="form-control" id="activity_instructions" cols="30" placeholder="Activity Instructions" rows="3" required></textarea>							
						</div>	   	
						<div class="form-group">
							<label for="activity_date" class="control-label">Activity Date:</label>							
							<input type="date" name="activity_date" class="form-control" id="activity_date"  required>							
						</div>	 
						<div class="form-group">
							<label for="playlist_id" class="control-label">Playlist  Id:</label>							
							<input type="text" name="playlist_id" class="form-control" id="playlist_id" placeholder="Playlist id" readonly>						
						</div>
						<div class="form-group">
							<label for="playlist_descr" class="control-label">Playlist  description:</label>							
							<input type="text" name="playlist_descr" class="form-control" id="playlist_descr" placeholder="Playlist  description" readonly>						
						</div>
						<div class="form-group">
							<label for="status" class="control-label">Activity Status :</label>							
							<select class="form-control" id="status" name="status" required>
									<option value="">Select</option>
									<option value="Free">Free</option>
									<option value="Paid">Paid</option>
								
								</select>	
								<input type="hidden" name="activity_no" class="form-control" id="activity_no">		
						</div>	
						
						</div>
											
    				</div>
					</div>
    				<div class="modal-footer">
    					<input type="hidden" name="empId" id="empId" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
</div>	
	