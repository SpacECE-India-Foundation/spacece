<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
?>
<div class="course_container">
    <div class="courses_filter">
        <div class="courses_filter_title">
            <h2>Filter Courses</h2>
        </div>
        <div class="courses_filter_form">
            <form action="">
                <div class="form_group">
                    <label for="">Course Name</label>
                    <input type="text" name="course_name" value="">
                </div>
                <div class="form_group">
                    <label for="">Category</label>
                    <select name="category">
                        <option value="">Select Category</option>
                        <option value="1">Web Development</option>
                        <option value="2">Mobile Development</option>
                        <option value="3">Graphic Design</option>
                    </select>
                </div>
                <div class="form_group">
                    <label for="">Level</label>
                    <select name="level">
                        <option value="">Select Level</option>
                        <option value="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Advanced</option>
                    </select>
                </div>
                <div class="form_group">
                    <label for="">Price</label>
                    <select name="price">
                        <option value="">Select Price</option>
                        <option value="1">Free</option>
                        <option value="2">Paid</option>
                    </select>
                </div>
                <input type="submit" value="Filter Courses">
            </form>
        </div>
    </div>
    <div id="courses">

    </div>
</div>
<?php
include_once '../common/footer_module.php';
?>