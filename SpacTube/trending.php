<?php

require_once 'Config/Functions.php';
$Fun_call = new Functions();
$fetch_video = "";
$trend_video_call = []; 
// Set videos per page
$videos_per_page = 12;

// Get current page from URL, default is 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate offset
$offset = ($page - 1) * $videos_per_page;


include_once './header_local.php';
include_once '../common/header_module.php';


$trend_video = $Fun_call->select_order('videos', 'cntlike', 'DESC');
$get_video = $Fun_call->selected_order('videos', 'filter', 'cntlike', 'DESC');

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=filter_alt" />

<div class="topright">
    <!-- <a href="logout.php"> -->
    <button onclick="window.open('logout.php', '_self')" type="button" style="background-color:black;color:white;border-radius:10px;">Logout</button>
    <!-- </a> -->
    <button onclick="window.open('https:/www.instamojo.com/@spacece/l3a3b190992504d639f4fb6fc9bfc40fe/', '_self')" type="button" style="color:white; background-color:black;border-radius: 10px;">Subscribe</button>
    <script src="https://js.instamojo.com/v1/button.js"></script>
    <!-- <a href="user.php">
                <button type="button">Upload Video</button>
            </a>
            <a href="user1.php">
                <button type="button">Remove Video</button>
            </a> -->
</div>
<body style="background-color: #eeeeee;">
<div class="container-fluid">

    <div class="container" style="margin-top: 20px;">
        <?php include 'menu.php'; ?>
    </div>

<?php include_once '../common/banner.php'; ?>

<style>
    
.heading-title {
  color: rgb(37, 35, 35);
  font-size: 35px;
  font-weight: normal;
  text-align: left;
  margin: 0;
  padding: 0;
}
.search-container {
  display: flex;
  align-items: center;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 10px;
  padding: 0 10px;
  width: 220px;
  height: 40px;
}

.search-container input {
  border: none;
  outline: none;
  flex: 1;
  font-size: 14px;
}

.search-container button {
  background: none;
  border: none;
  cursor: pointer;
  color: #333;
  font-size: 16px;
}

select#filterr {
  height: 40px;
  padding: 0 12px;
  border-radius: 10px;
  font-size: 14px;
}

.top-filter-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.filter-search-form {
  display: flex;
  width: 100%;
  justify-content: space-between;
  gap: 10px;
}

.custom-select-wrapper {
  position: relative;
  width: 220px;
}

.custom-select {
  appearance: none;
  width: 100%;
  padding: 12px 40px 12px 40px;
  border: 1px solid #ccc;
  border-radius: 12px;
  background-color: white;
  font-size: 16px;
  color: #333;
  outline: none;
  cursor: pointer;
}

.custom-select:focus {
  border-color: #80bdff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.2);
}

.custom-select-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 20px;
  color: #888;
  pointer-events: none;
}

.custom-select-arrow {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 14px;
  color: #666;
  pointer-events: none;
}

a:hover i {
  color:rgb(242, 170, 46);
}

.pagination-container {
  display: flex;
  justify-content: center;
  align-items: center;
  background:rgb(255, 255, 255);
  border-radius: 16px;
  padding: 20px 40px;
  width: fit-content;
  margin: 30px auto;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  transform: translateX(117%);
}


.pagination-button {
  padding: 10px 18px;
  background: white;
  border: 2px solid #ccc;
  border-radius: 10px;
  text-decoration: none;
  color: black;
  font-weight: bold;
  font-size: 20px;
  margin: 0 5px;
}


.pagination-button.disabled {
  color: #aaa;
  pointer-events: none;
}

.pagination-page-info {
  font-size: 18px;
  color: #333;
  margin: 0 15px;
}


</style>

<div class="container">
  <div class="ins-box" style="border: none; box-shadow: none;">
  <div class="container">
    <div class="container">
      <div class="heading-title" style="color: black; text-align: left; margin-left: 0;">Our Free Videos</div>
    </div>
  </div>
</div>
            <br>
            <div class="top-filter-bar">
  <form action="trending.php" method="post" class="filter-search-form">
    <div class="search-container">
      <input type="text" name="search_query" placeholder="Search for videos" />
      <button type="submit" name="Submit">
        <i class="fas fa-search"></i>
      </button>
    </div>
    <div class="custom-select-wrapper">
  <span class="material-symbols-outlined custom-select-icon">filter_alt</span>
  <select class="custom-select" name="filterr" id="filterr" style="appearance: none; width: 100%; padding: 5px 40px 6px 30px; border: 1px solid #ccc; border-radius: 12px; background-color: white; font-size: 14px; color: #666; outline: none;">
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
</div>


            <?php $abc = isset($_POST['filterr']) ? $_POST['filterr'] : 'all';
$search_query = isset($_POST['search_query']) ? trim($_POST['search_query']) : '';
$videos_per_page = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $videos_per_page;

$search_query = isset($_POST['search_query']) ? trim($_POST['search_query']) : (isset($_GET['search_query']) ? trim($_GET['search_query']) : '');
$abc = isset($_POST['filterr']) ? $_POST['filterr'] : (isset($_GET['filterr']) ? $_GET['filterr'] : 'all');

$all_videos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($search_query !== '') {
        $all_videos = $Fun_call->search_and_filter_videos('videos', $abc, $search_query);
    } else {
        $all_videos = $Fun_call->trend_video_cat('videos', $abc, 'views', 'DESC');
    }
} else {
    $all_videos = $Fun_call->select_order('videos', 'cntlike', 'DESC');
}

$total_videos = count($all_videos);
$total_pages = ceil($total_videos / $videos_per_page);
$trend_video_call = array_slice($all_videos, $offset, $videos_per_page);
?>
            <br>
            <div class="row row-cols-1 row-cols-md-2">
                <?php

                if ($trend_video_call) {
                    // var_dump($trend_video_call);
                    foreach ($trend_video_call as $video_data) {

                ?>
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <div class="set-box youtube-video-r">
                                        <iframe width="560" height="316" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


                                    </div>
                                    <div class="card-body pt-2 pb-2">
                                        <h6 class="card-title">
                                            <?php echo $video_data['title']; ?></h6>
                                        
                                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px;">

                                            <div style="display: flex; gap: 20px;">
                                              <a href="likecnt.php?btn=<?php echo $video_data['v_id']; ?>" style="color: #333; font-size: 22px;">
                                                <i class="fa-regular fa-thumbs-up"></i>
                                              </a>
                                              <a href="likecnt.php?btn1=<?php echo $video_data['v_id']; ?>" style="color: #333; font-size: 22px;">
                                                <i class="fa-regular fa-thumbs-down"></i>
                                              </a>
                                            </div>

                                            <a href="whatsapp://send?text=<?php echo '...'; ?>" target="_blank" style="color: #000; font-size: 22px;">
                                              <i class="fas fa-share-alt"></i>
                                            </a>
                                          </div>



<!-- <a href="comment.php">
                                <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
                            </a> -->

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {


                    $i = 0;
                    if ($trend_video) {
                        foreach ($trend_video as $video_data) {
                            if ($i < 5) {
                                $i++;
                            ?>
                                <div class="col mb-4">
                                    <div class="card h-100">
                                        <div class="set-box youtube-video-r">
                                            <iframe width="560" height="316" src="https://www.youtube.com/embed/<?php echo $video_data['v_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


                                        </div>
                                        <div class="card-body pt-2 pb-2">
                                            <h6 class="card-title">
                                                <?php echo $video_data['title']; ?></h6>
                                           
                                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px;">
                                                
                                                <div style="display: flex; gap: 20px;">
                                                  <a href="likecnt.php?btn=<?php echo $video_data['v_id']; ?>" style="color: #333; font-size: 22px;">
                                                    <i class="fa-regular fa-thumbs-up"></i>
                                                  </a>
                                                  <a href="likecnt.php?btn1=<?php echo $video_data['v_id']; ?>" style="color: #333; font-size: 22px;">
                                                    <i class="fa-regular fa-thumbs-down"></i>
                                                  </a>
                                                </div>

                                                
                                                <a href="whatsapp://send?text=<?php echo '...'; ?>" target="_blank" style="color: #000; font-size: 22px;">
                                                  <i class="fas fa-share-alt"></i>
                                                </a>
                                              </div>


<!-- <a href="comment.php">
                                <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
                            </a> -->

                                        </div>
                                    </div>
                                </div>
                <?php
                            }
                        }
                    }
                } ?>

            </div>
            <?php if ($total_pages > 1): ?>
    <div class="pagination-container">
        <?php if ($page > 1): ?>
            <a class="pagination-button" href="?page=<?php echo $page - 1; ?>&filterr=<?php echo urlencode($abc); ?>&search_query=<?php echo urlencode($search_query); ?>">&lt;</a>
        <?php else: ?>
            <span class="pagination-button disabled">&lt;</span>
        <?php endif; ?>

        <span class="pagination-page-info">Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>

        <?php if ($page < $total_pages): ?>
            <a class="pagination-button" href="?page=<?php echo $page + 1; ?>&filterr=<?php echo urlencode($abc); ?>&search_query=<?php echo urlencode($search_query); ?>">&gt;</a>
        <?php else: ?>
            <span class="pagination-button disabled">&gt;</span>
        <?php endif; ?>
    </div>
<?php endif; ?>


        </div>
    </div>



    <div class="all-v-btn btn btn-outline-dark">
        <a href="home.php"><i class="fi-xwluxl-gear-wide fi-2x fi-flip-h"></i></a>
    </div>

    <!--End - Delete - Modal -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            </body>
    <?php include_once '../common/footer_module.php'; ?>