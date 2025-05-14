<?php
$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
?>

<style>
    body {
        margin: 0;
        padding: 0;
    }

    .header {
        display: flex;
        align-items: center;
        padding: 10px 10px;
    }

    .header img {
        height: 40px;
        margin-right: 10px;
    }

    .header-title {
        font-weight: bold;
        font-size: 16px;
        margin-right: 30px;
    }

    .button-wrapper {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        padding: 10px 20px;
        transform: translateX(-390px);
        margin-top: 100px;
        gap: 10px;
    }

    .btn-custom {
        border-radius: 10px;
        padding: 10px 20px;
        margin-right: 10px;
        margin-bottom: 10px;
        min-width: 150px;
        color: #111;
    }
</style>

<!-- Button Section -->
<div class="button-wrapper">
    <button onclick="window.location.href = 'view.php';"
        class="btn btn-custom <?php echo ($page == 'view') ? 'btn-light border' : 'btn-outline-secondary'; ?>">
        Free Section
    </button>

    <button onclick="window.location.href = 'view1.php';"
        class="btn btn-custom <?php echo ($page == 'view1') ? 'btn-light border' : 'btn-outline-secondary'; ?>">
        Paid Section
    </button>

    <button onclick="window.location.href = 'trending.php';"
        class="btn btn-custom <?php echo ($page == 'trending') ? 'btn-light border' : 'btn-outline-secondary'; ?>">
        Trending Section
    </button>

    <button onclick="window.location.href = 'audio_book.php';"
        class="btn btn-custom <?php echo ($page == 'audio_book') ? 'btn-light border' : 'btn-outline-secondary'; ?>">
        Audio Book Section
    </button>
</div>
