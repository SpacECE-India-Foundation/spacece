
<?php 

if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `babysitter_list` where id ='{$_GET['id']}' ");
    if($qry->num_rows > 0 ){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k=$v;
            }
        }
        $meta_qry = $conn->query("SELECT * FROM `babysitter_details` where babysitter_id = '{$_GET['id']}' ");
        if($meta_qry->num_rows > 0 ){
            while($row= $meta_qry->fetch_assoc()){
                ${$row['meta_field']} = $row['meta_value'];
            }
        }
    }
}

?>
<style>
    #cimg{
        object-fit:scale-down;
        object-position:center center;
        height:200px;
        width:200px;
    }
</style>
<div class="content py-3">
    <div class="container-fluid">
        <div class="card card-outline card-info shadow rounded-0">
            <div class="card-header">
                <h4 class="card-title"><?= isset($id) ? "Add New Baby Sitter" : "Manage Baby Sitter"; ?></h4>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form action="" id="babysitter-form">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                        <fieldset>
                            <legend class="text-navy">Personal Information</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="firstname" class="control-label text-primary">First Name</label>
                                    <input type="text" autofocus class="form-control form-control-border" name="firstname" id="firstname" required value="<?= isset($firstname) ? $firstname : "" ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="middlename" class="control-label text-primary">Middle Name</label>
                                    <input type="text" class="form-control form-control-border" name="middlename" id="middlename" placeholder="(Optional)..." value="<?= isset($middlename) ? $middlename : "" ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lastname" class="control-label text-primary">Last Name</label>
                                    <input type="text" class="form-control form-control-border" name="lastname" id="lastname" required value="<?= isset($lastname) ? $lastname : "" ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="" class="control-label text-primary">Gender</label>
                                </div>
                                <div class="form-group col-auto">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="genderMale" name="gender" value="Male" required <?= isset($gender) && $gender == "Male" ? "checked" : "" ?>>
                                        <label for="genderMale" class="custom-control-label">Male</label>
                                    </div>
                                </div>
                                <div class="form-group col-auto">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="genderFemale" name="gender" value="Female" <?= isset($gender) && $gender == "Female" ? "checked" : "" ?>>
                                        <label for="genderFemale" class="custom-control-label">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="email" class="control-label text-primary">Email</label>
                                    <input type="email" class="form-control form-control-border" name="email" id="email" required  value="<?= isset($email) ? $email : "" ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="contact" class="control-label text-primary">Contact #</label>
                                    <input type="text" class="form-control form-control-border" name="contact" id="contact" required value="<?= isset($contact) ? $contact : "" ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="address" class="control-label text-primary">Address</label>
                                    <textarea name="address" id="address" class="form-control form-control-border" rows="2" required><?= isset($address) ? $address : "" ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="skills" class="control-label text-primary">Skills</label>
                                    <textarea name="skills" id="skills" class="form-control form-control-border" rows="2" required><?= isset($skills) ? $skills : "" ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-navy">Professional Information</legend>
                            <div class="form-group col-md-4">
                                <label for="years_experience" class="control-label text-primary">Years of Experience</label>
                                <input type="number" class="form-control form-control-border text-right" name="years_experience" id="years_experience" required value="<?= isset($years_experience) ? $years_experience : "" ?>">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="achievement" class="control-label text-primary">Achievements</label>
                                    <textarea name="achievement" id="achievement" class="form-control form-control-border" rows="2" placeholder="Write Achievements here (If Any)"><?= isset($achievement) ? $achievement : "" ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="other" class="control-label text-primary">Other Information</label>
                                    <textarea name="other" id="other" class="form-control form-control-border" rows="2" placeholder="Write here"><?= isset($other) ? $other : "" ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-navy">Image</legend>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="img" class="control-label text-muted">Choose Image</label>
                                    <input type="file" id="img" name="img" class="form-control form-control-border" accept="image/png,image/jpeg" onchange="displayImg(this,$(this))">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <center>
                                        <img src="<?= validate_image(isset($id) ? "uploads/babysitters/{$id}.png" : "").(isset($date_updated) ? "?v=".strtotime($date_updated) : "") ?>" alt="Babysitter Image" id="cimg" class="bg-gradient-dark">
                                    </center>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="" class="control-label">Status</label>
                                <select name="status" id="status" class="form-control form-control-border" required>
                                    <option value="1" <?= isset($status) && $status == 1 ? "selected" :"" ?>>Active</option>
                                    <option value="0" <?= isset($status) && $status == 0 ? "selected" :"" ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-flat btn-primary" form="babysitter-form"><i class="fa fa-save"></i> Save</button>
                    <a href="./?page=babysitters" class="btn btn-flat btn-light border"><i class="fa fa-angle-left"></i> Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
            $('#cimg').attr('src', "<?= validate_image(isset($avatar) ? $avatar : "") ?>");
        }
	}
    $(function(){
        $('#babysitter-form').submit(function(e){
            e.preventDefault()
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_babysitter",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.href ="./?page=babysitters";
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html, body').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>