<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

require_once 'Config/Functions.php';
$Fun_call = new Functions();
$fetch_video = "";

include_once './header_local.php';
include_once '../common/header_module.php';

$trend_video = $Fun_call->select_order('videos', 'cntlike', 'DESC');

?>
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">

<!-- Heading -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=filter_alt" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


<div class="topright">
    <button onclick="window.open('logout.php', '_self')" type="button" style="background-color:black;color:white;border-radius:10px;">Logout</button>
    <button onclick="window.open('https:/www.instamojo.com/@spacece/l3a3b190992504d639f4fb6fc9bfc40fe/', '_self')" type="button" style="color:white; background-color:black;border-radius: 10px;">Subscribe</button>
    <script src="https://js.instamojo.com/v1/button.js"></script>
</div>

<div class="container-fluid">
<body style="background-color: #eeeeee;">

    <div class="container">
        <?php include 'menu.php'; ?>
    </div>

    <?php include_once '../common/banner.php';?>
<style>
  .filter-search-form {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
  }

  .search-container {
    position: relative;
    width: 220px;
  }

  .search-container input[type="text"] {
    width: 100%;
    padding: 10px 40px 10px 15px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 16px;
    background-color: white;
    outline: none;
  }

  .search-container i {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #333;
    font-size: 18px;
    pointer-events: none;
  }

  .custom-select-wrapper {
    display: flex;
    align-items: center;
  }

  .custom-select-wrapper .custom-select-icon {
    margin-right: 8px;
    font-size: 22px;
    color: #333;
  }

  .custom-select-wrapper select {
    padding: 8px 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
    color: #666;
    background-color: white;
    appearance: none;
    outline: none;
  }
  .custom-select-wrapper {
  position: relative;
  width: 220px;
}

.custom-select-wrapper select {
  width: 100%;
  padding: 10px 40px 10px 38px; /* More left space for icon */
  border-radius: 10px;
  border: 1px solid #ccc;
  font-size: 16px;
  background-color: white;
  color: #333;
  appearance: none;
  outline: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg fill='%23333' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 18px;
}

.custom-select-wrapper .custom-select-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 18px;
  color: #333;
  pointer-events: none;
}

</style>

    <div class="container">
        <div style="border: none; background: none; padding: 0;">

            <div class="container">
                <h2 style="
    font-family: 'Roboto', sans-serif;
    font-size: 32px;
    color: #222;
    text-align: left;
    margin: 30px 0 10px 15px;
    letter-spacing: 0.5px;
">
    Our Audio-Books
</h2>

            </div>

            <br>
           <form action="audio_book.php" method="post" class="filter-search-form">
            <!-- Search Box -->
            <div class="search-container">
                <input type="text" name="search_query" placeholder="Search for videos" />
                <i class="fas fa-search"></i>
            </div>

            <!-- Filter Dropdown -->
            <div class="custom-select-wrapper">
            <span class="material-symbols-outlined custom-select-icon">filter_alt</span>
            <select name="filterr" id="filterr">
                <option value="all">Filter</option>
                <?php
                if ($get_video) {
                    foreach ($get_video as $video_data) {
                    echo "<option value='" . $video_data['filter'] . "'>" . $video_data['filter'] . "</option>";
                    }
                }
                ?>
            </select>
            </div>

            </form>


            <br>

            <div class="row row-cols-1 row-cols-md-2">
                <?php
                if ($trend_video) {
                    
                    foreach ($trend_video as $video_data) {
                       
                ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <div class="set-box youtube-video-r">
                            <iframe width="560" height="316" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="card-body pt-2 pb-2">
                            <h6 class="card-title"><?php echo $video_data['title']; ?></h6>
                            <div class="card-body pt-2 pb-2">
    <!-- NEW layout below -->
    <div class="d-flex justify-content-between align-items-center mt-2">
        <div>
            <a href="likecnt.php?btn=<?php echo $video_data['v_id']; ?>" class="mr-2">
                <button name="likecnt" class="btn p-0"><i class="fa-regular fa-thumbs-up" style="color:black; font-size: 1.2rem;"></i></button>
            </a>
            <?php echo $video_data['cntlike']; ?>
            <a href="likecnt.php?btn1=<?php echo $video_data['v_id']; ?>" class="ml-2">
                <button name="dislikecnt" class="btn p-0"><i class="fa-regular fa-thumbs-down" style="color:black; font-size: 1.2rem;"></i></button>
            </a>
            <?php echo $video_data['cntdislike']; ?>
        </div>
        <div>
            <button name="share" class="btn p-0">
                <a href="whatsapp://send?text=<?php echo urlencode("SpacTube - Video Gallery on Child Education\n\nWatch: https://www.youtube.com/watch?v=" . $video_data['v_url'] . "\n\nSubscribe: https://www.spacece.co/offerings/spactube"); ?>" data-action="share/whatsapp/share" target="_blank">
                    <i class="fas fa-share-alt" style="color:black; font-size: 1.2rem;"></i>
                </a>
            </button>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                 else {
                    echo "<h2>No book found</h2>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="all-v-btn btn btn-outline-dark">
        <a href="home.php"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
<?php include_once '../common/footer_module.php'; ?>
