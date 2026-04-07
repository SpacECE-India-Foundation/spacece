    <?php
    require_once 'Config/Functions.php';
    $Fun_call = new Functions();

    include_once './header_local.php';
    include_once '../common/header_module.php';
    include_once '../common/banner.php';

    ?>

    <div class="container" style="background-color: white">

        <div class="container">
            <button onclick="window.open('user.php', '_self')" name="upload" class="btn-btn" style="background-color:orange;">
                <h6>Upload Video</h6>
            </button>

            <button onclick="window.open('user1.php', '_self')" name="remove" class="btn-btn" style="background-color:orange;">
                <h6>Remove Video</h6>
            </button>

        </div>

        <div class="container">
            <div class="ins-box" id="load_videos">
            </div>
        </div>
    </div>


    <div class="all-v-btn btn btn-outline-dark">
        <a href="view.php"><i class="fi-xwluxl-table-wide fi-2x"></i></a>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js'></script>
    <script src='https://code.jquery.com/jquery-3.4.1.min.js' integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>

    <script type='text/javascript'>
        $(function() {
            $('#load_videos').load('Ajax/Load_gallery.php');


            $.validator.setDefaults({
                submitHandler: function() {


                    $video_url = $('#video_code').val().trim();
                    alert($video_url);
                    $('#ins_status').text('');
                    if ($video_url != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'Ajax/Video_process.php',
                            data: {
                                'video_url': encodeURIComponent($video_url)
                            },
                            success: function(response) {
                                $json_res = JSON.parse(response);
                                alert(response);
                                if ($json_res.status == 101) {
                                    // $('#load_videos').load('Ajax/Load_gallery.php');
                                    //  $('#ins_status').text('Successfully Video Added');
                                    //  $('#video-ins').trigger('reset');
                                } else {
                                    console.log($json_res.msg);
                                }
                            }
                        });
                    } else {
                        $('#ins_status').text('Please Enter Video Code');
                    }
                }
            });
            $('#video-ins').validate({
                rules: {
                    video_code: {
                        required: true,

                    },
                    date: {
                        required: true,
                    },
                    title: {
                        required: true,
                    },
                    desc: {
                        required: true,
                    },
                    length: {
                        required: true,
                    },
                    filter: {
                        required: true,
                    },
                    status: {
                        required: true,
                    }
                },
                messages: {
                    video_code: {
                        required: 'Please enter Valid Video code',

                    },
                    date: {
                        required: 'Please enter Uploaded Date',
                    },
                    title: {
                        required: 'Please enter Video title',
                    },
                    desc: {
                        required: 'Please Enter Video Decription',
                    },
                    length: {
                        required: 'Please enyer Video length',
                    },
                    filter: {
                        required: 'Please Enter Filter category',
                    },
                    status: {
                        required: 'Please select Status',
                    }
                }
            });
        });
    </script>


    <?php include_once '../common/footer_module.php'; ?>