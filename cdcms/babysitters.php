<style>
    #bs-image{
        width:10em;
        height:10em;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
    .bs-item{
        transition:transform 3s ease-in;
    }
    .bs-item:focus{
        transform:scale(.95)
    }
</style>
<div class="content py-3">
    <div class="container-fluid">
        <h3 class="text-center"><b>Our Babysitters</b></h3>
        <hr class="bg-navy">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="input-group mb-2">
                    <input type="search" id="search" class="form-control form-control-border" placeholder="Search Babysitter here...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm border-0 border-bottom btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-3 justify-content-center gx-3 gy-3">
            <?php 
            $babysitters = $conn->query("SELECT * FROM babysitter_list where status = 1 order by `fullname` asc");
            while($row = $babysitters->fetch_assoc()):
            ?>
                <a class="col bs-item text-decoration-none text-dark" href="javascript:void(0)" data-id="<?= $row['id'] ?>">
                    <div class="callout callout-info rounded-0 shadow">
                    <div class="text-center">
                        <img id="bs-image" class="img-thumbnail bg-gradient-dark border-info" src="<?php echo validate_image(isset($row['id']) ? "uploads/babysitters/{$row['id']}.png" : "").(isset($row['date_updated']) ? "?v=".strtotime($row['date_updated']) : "") ?>" alt="BS Image">
                    </div>
                    <h4 class="text-center"><b><?= ucwords($row['fullname']) ?></b></h4>
                    <div class="text-center"><small class="text-muted"><?= $row['code'] ?></small></div>
                    </div>
                </a>
            <?php endwhile; ?>
            <?php if($babysitters->num_rows < 1): ?>
                <center><span class="text-muted">No Babysitter Listed Yet.</span></center>
            <?php endif; ?>
                <div id="no_result" style="display:none"><center><span class="text-muted">No Result.</span></center></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#search').on("input",function(e){
            var _search = $(this).val().toLowerCase()
            $('.bs-item').each(function(){
                var _txt = $(this).text().toLowerCase()
                if(_txt.includes(_search) === true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
                if($('.bs-item:visible').length <= 0){
                    $("#no_result").show('slow')
                }else{
                    $("#no_result").hide()
                }
            })
        })
        $('.bs-item').click(function(){
            uni_modal("Babysitter's Details","view_babysitter.php?id="+$(this).attr('data-id'),'mid-large')
        })
    })
    
</script>