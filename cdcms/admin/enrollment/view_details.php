<?php require_once("../../config.php"); ?>
<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * from `enrollment_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    $meta_qry = $conn->query("SELECT * FROM `enrollment_details` where enrollment_id = '{$id}'");
    if($meta_qry->num_rows > 0){
        while($row = $meta_qry->fetch_assoc()){
            ${$row['meta_field']} = $row['meta_value'];
        }
    }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <div id="outprint">
        <div class="text-muted">Enrollment Code</div>
        <h4 class=""><b><?= isset($code) ? $code : "" ?></b></h4>
        <hr class="bg-navy">
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <legend class="text-navy">Child's Information</legend>
                    <dl>
                        <dt class="text-muted">Full Name</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($child_fullname) ? $child_fullname : '' ?></dd>
                        <dt class="text-muted">Gender</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($gender) ? $gender : '' ?></dd>
                        <dt class="text-muted">Birthday</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($child_dob) ? date("M d, Y",strtotime($child_dob)) : '' ?></dd>
                    </dl>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend class="text-navy">Parent/Guardian's Information</legend>
                    <dl>
                        <dt class="text-muted">Full Name</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($parent_fullname) ? $parent_fullname : '' ?></dd>
                        <dt class="text-muted">Contact #</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($parent_contact) ? $parent_contact : '' ?></dd>
                        <dt class="text-muted">Email</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($email) ? $email : '' ?></dd>
                        <dt class="text-muted">Address</dt>
                        <dd class='pl-4 fs-4 fw-bold'><?= isset($address) ? $address : '' ?></dd>
                    </dl>
                </fieldset>
            </div>
        </div>
        <hr class="bg-navy">
        <div class="text-muted">Status</div>
        <div class="pl-4">
            <?php
                switch($status){
                    case '1':
                        echo "<span class='badge badge-primary badge-pill'>Confirmed</span>";
                        break;
                    case '0':
                        echo "<span class='badge badge-secondary badge-pill'>Pending</span>";
                        break;
                }
            ?>
        </div>
    </div>
    <div class="rounded-0 text-center">
            <button class="btn btn-sm btn-success btn-flat" type="button" id="print"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
<script>
    $(function(){
        $('#print').click(function(){
            var _h = $("head").clone()
            var _p = $('#outprint').clone()
            var el = $("<div>")
            start_loader()
            $('script').each(function(){
                if(_h.find('script[src="'+$(this).attr('src')+'"]').length <= 0){
                    _h.append($(this).clone())
                }
            })
            _h.find('title').text("Enrollment's Details - Print View")
            _p.prepend("<hr class='border-navy bg-navy'>")
            _p.prepend("<div class='mx-5 py-4'><h1 class='text-center'>Enrollment Details</h1>"
                        +"<h5 class='text-center'><?= isset($code) ? $code : "" ?></h5></div>")
            _p.prepend("<img src='<?= validate_image($_settings->info('logo')) ?>' id='print-logo' />")
            el.append(_h)
            el.append(_p)

            var nw = window.open("","_blank","height=800,width=1200,left=200")
                nw.document.write(el.html())
                nw.document.close()
                setTimeout(()=>{
                    nw.print()
                    setTimeout(() => {
                        nw.close()
                        end_loader()
                    }, 300);
                },300)
        })
    })
</script>