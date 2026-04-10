$(document).ready(function () {
  //Login Function Start
  $("#formLogin").submit(function (e) {
    e.preventDefault();
    if ($("#email").val() == "" || $("#password").val() == "") {
      alert("Please fill all the fields!");
    } else {
      $.ajax({
        url: "http://educationfoundation.space/spacece/api/auth/learnonapp_login",
        type: "POST",
        data: {
          login: 1,
          email: $("#email").val(),
          password: $("#password").val(),
        },
        success: function (d) {
          const user = JSON.parse(d);
          console.log(user.data);
        },
      });
    }
  });
  //Login Function End

  //Registration Function Start
  $("#formRegistration").submit(function (e) {
    e.preventDefault();
    if (
      $("#name").val() == "" ||
      $("#email").val() == "" ||
      $("#password").val() == "" ||
      $("#cpassword").val() == "" ||
      $("#phone").val() == ""
    ) {
      alert("Please fill all the fields!");
    } else {
      if ($("#password").val() != $("#cpassword").val()) {
        alert("Password does not match!");
      } else {
        $.ajax({
          url: "http://educationfoundation.space/spacece/api/auth/learnonapp_register",
          type: "POST",
          data: {
            register: 1,
            name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            phone: $("#phone").val(),
          },
          success: function (d) {
            const user = JSON.parse(d);
            console.log(user.data);
          },
        });
      }
    }
  });
  //Registration Function End

  //Fetching Courses Function Start
  $.ajax({
    url: "http://educationfoundation.space/spacece/api/learnonapp_courses",
    type: "GET",
    success: function (d) {
      if (d.status == "success") {
        const courses = d.data;
        $("#courses").html(
          courses.map((course) => {
            return `<div class="course">
            <div class="card">
              <div class="card-body">
                <strong class="card-title">${course.title}</strong>
                <p class="card-text">${course.description}</p>
                <p class="card-type">Type: ${course.type}</p>
                <p class="card-mode">Mode: ${course.mode}</p>
                <a href="course.php?id=${course.id}" class="btn">
                  View Course
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

  //Fetching Single Course Function Start
  let params = new URL(document.location).searchParams;
  let id = params.get("id");
  if (id) {
    $.ajax({
      url: `http://educationfoundation.space/spacece/api/learnonapp_courses?cid=${id}`,
      type: "GET",
      success: function (d) {
        if (d.status == "success") {
          const course = d.data[0];
          $("#course_details").html(
            `<div class="single_course">
            <div class="single_course_body">
              <strong class="single_course_title">${course.title}</strong>
              <p class="single_course_text">${course.description}</p>
              <p class="single_course_type">Type: ${course.type}</p>
              <p class="single_course_mode">Mode: ${course.mode}</p>
              <a href="course.php?id=${course.id}" class="btn">
                Buy Course
              </a>
            </div>
          </div>`
          );
        }
      },
    });
  }
  //Fetching Single Course Function End
});
