<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include '../Db_Connection/db_spacece.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and get course fields
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $description = $conn->real_escape_string($_POST['description'] ?? '');
    $level = $conn->real_escape_string($_POST['level'] ?? '');
    $category = $conn->real_escape_string($_POST['category'] ?? '');
    $logo = $conn->real_escape_string($_POST['logo'] ?? '');
    $duration = $conn->real_escape_string($_POST['duration'] ?? '');
    $skill_gained = $conn->real_escape_string($_POST['skill_gained'] ?? '');
    $price = $conn->real_escape_string($_POST['price'] ?? '');

    // Insert course
    $sql = "INSERT INTO learnonapp_courses 
            (title, description, level, category, logo, duration, skill_gained, price)
            VALUES ('$title', '$description', '$level', '$category', '$logo', '$duration', '$skill_gained', '$price')";

    if ($conn->query($sql)) {
        $course_id = $conn->insert_id;

        // Insert videos (arrays: video_title[], video_link[], sort_order[])
        $video_titles = $_POST['video_title'] ?? [];
        $video_links = $_POST['video_link'] ?? [];
        $sort_orders = $_POST['sort_order'] ?? [];

        for ($i = 0; $i < count($video_titles); $i++) {
            $v_title = $conn->real_escape_string($video_titles[$i]);
            $v_link = $conn->real_escape_string($video_links[$i]);
            $v_order = intval($sort_orders[$i]);

            if (!empty($v_title) && !empty($v_link)) {
                $conn->query("INSERT INTO learnonapp_videos 
                    (course_id, video_title, video_link, sort_order)
                    VALUES ('$course_id', '$v_title', '$v_link', '$v_order')");
            }
        }

        echo "✅ Course and videos added successfully!";
    } else {
        echo "❌ Error adding course: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add New Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
        }

        .video-group {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 12px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-5 pt-5">
        <h2>Add New Course</h2>
        <div class="mb-5">
            <a href="index.php">
                <button class="">← Back</button></a>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div id="course-form">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="title">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea id="description" name="description" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label>Level</label>
                    <select id="level" name="level">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" id="category">
                </div>

                <div class="form-group">
                    <label>Logo File Name (e.g., logo.png)</label>
                    <input type="text" name="logo" id="logo">
                </div>

                <div class="form-group">
                    <label>Duration</label>
                    <input type="text" id="duration" name="duration" placeholder="e.g., 3h 15m">
                </div>

                <div class="form-group">
                    <label>Skills Gained</label>
                    <input type="text" id="skill_gained" name="skill_gained" placeholder="e.g., Swaddling, Burping">
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" id="price" name="price" placeholder="e.g., 349">
                </div>

                <hr>
                <h3>Videos</h3>
                <div id="videos-container"></div>
                <button type="button" onclick="addVideo()">➕ Add Video</button>

                <br><br>
                <button type="submit" name="submit">✅ Submit Course</button>
                <div id="result" style="margin-top:20px;"></div>
            </div>
        </form>
    </div>


    <script>
        function addVideo() {
            const container = document.getElementById('videos-container');
            const index = container.children.length;

            const html = `
        <div class="video-group">
          <label>Video Title</label>
          <input type="text" name="video_title[]" class="video-title">

          <label>Video URL</label>
          <input type="text" name="video_link[]" class="video-url">

          <label>Sort Order</label>
          <input type="number" name="sort_order[]" class="video-order">
        </div>
      `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>

</body>

</html>