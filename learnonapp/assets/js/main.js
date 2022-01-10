$(document).ready(function () {
  //Fetching Courses Function Start
  $.ajax({
    url: "../api/learnonapp_courses.php",
    // url: "https://spacefoundation.in/test/SpacECE-PHP/api/learnonapp_courses.php",
    type: "GET",
    success: function (d) {
      if (d.status == "success") {
        const courses = d.data;
        $("#courses").html(
          courses.map((course) => {
            return `<div class="course">
                <img src="https://spacefoundation.in/test/SpacECE-PHP/img/logo/SpacECELogo.jpg" alt="${course.title}">
                <div class="list-content">
                  <div class="list-body mb-20">
                    <strong class="list-title">${course.title}</strong>
                  </div>
                  <p class="list-text">${course.description}</p >
                  <div class="list-body">
                    <div class="list-misc">
                      <p class="list-type"><strong>Type:</strong> ${course.type}</p>
                      <p class="list-mode"><strong>Mode:</strong> ${course.mode}</p>
                    </div>
                    <a href="course.php?id=${course.id}" class="btn">
                      Know More
                    </a>
                  </div>
                </div>
          </div>`;
          })
        );
      }
    },
  });
  //Fetching Courses Function End

  //Fetching Customer Function Start
  $.ajax({
    url: "../api/learnonapp_courses.php",
    // url: "https://spacefoundation.in/test/SpacECE-PHP/api/learnonapp_courses.php",
    type: "GET",
    success: function (d) {
      if (d.status == "success") {
        const courses = d.data;
        $("#my_courses").html(
          courses.map((course) => {
            return `<div class="course">
                <img src="https://spacefoundation.in/test/SpacECE-PHP/img/logo/SpacECELogo.jpg" alt="${course.title}">
                <div class="list-content">
                  <div class="list-body mb-20">
                    <strong class="list-title">${course.title}</strong>
                  </div>
                  <p class="list-text">${course.description}</p >
                  <div class="list-body">
                    <div class="list-misc">
                      <p class="list-type"><strong>Type:</strong> ${course.type}</p>
                      <p class="list-mode"><strong>Mode:</strong> ${course.mode}</p>
                    </div>
                    <a href="course.php?id=${course.id}" class="btn">
                      Start Course
                    </a>
                  </div>
                </div>
          </div>`;
          })
        );
      }
    },
  });
  //Fetching Customer Function End

  //Fetching Single Course Function Start
  let params = new URL(document.location).searchParams;
  let id = params.get("id");
  if (id) {
    $.ajax({
      url: `../api/learnonapp_courses.php?cid=${id}`,
      // url: `https://spacefoundation.in/test/SpacECE-PHP/api/learnonapp_courses.php?cid=${id}`,
      type: "GET",
      success: function (d) {
        if (d.status == "success") {
          const course = d.data[0];
          $("#course_details").html(
            `<form action="./payment.php" method="POST" class="single_course">
            <div class="single_course_body">
              <div>
                <strong class="single_course_title">${course.title}</strong>
                <p class="single_course_text">${course.description}</p>
                <p class="single_course_type">Type: ${course.type}</p>
                <p class="single_course_mode">Mode: ${course.mode}</p>
              </div>
              <img src="https://spacefoundation.in/test/SpacECE-PHP/img/logo/SpacECELogo.jpg" alt="${course.title}">
            </div>
            <input type="hidden" name="course_id" value="${course.id}">
            <input type="hidden" name="course_total" value="${course.price}">
            <button type="submit" class="btn btn-wide">
              Buy Course
            </button>
          </form>`
          );
        }
      },
    });
  }
  //Fetching Single Course Function End
});
