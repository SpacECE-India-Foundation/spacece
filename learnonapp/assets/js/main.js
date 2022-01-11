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

  // Admin Page Details
  $.ajax({
    url: "../api/learnonapp_courses.php",
    // url: "https://spacefoundation.in/test/SpacECE-PHP/api/learnonapp_courses.php",
    type: "GET",
    success: function (d) {
      if (d.status == "success") {
        const courses = d.data;
        $("#admin-page").html(`
          <table id="admin-table">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Duration</th>
              <th>Mode</th>
              <th>Type</th>
              <th>Price</th>
              <th></th>
            </tr>
            ${courses.map((course) => {
              return `<tr id="tr-${course.id}">
                    <td id="td-id-${course.id}">${course.id}</td>
                    <td id="td-title-${course.id}">${course.title}</td>
                    <td id="td-description-${course.id}">${
                course.description
              }</td>
                    <td id="td-duration-${course.id}">${course.duration}</td>
                    <td id="td-mode-${course.id}">${course.mode}</td>
                    <td id="td-type-${course.id}">${course.type}</td>
                    <td id="td-price-${course.id}">${course.price}</td>
                    <td>
                      <button class="btn btn-wide" onclick="${editCourse(
                        course.id
                      )}">Edit</button><br>
                      <button class="btn btn-wide" onclick="${editCourse(
                        course.id
                      )}">Delete</button>
                    </td>
              </tr>`;
            })}
          </table>`);
      }
    },
  });

  // Admin Page Edit Course
  function editCourse(id) {
    $(`#tr-${id}`).html(
      `<td id="td-id-${id}">${id}</td>
      <td><input type="text" id="title-${id}" value="${$(
        `#td-title-${id}`
      ).text()}"></td>
      <td><input type="text" id="description-${id}" value="${$(
        `#td-description-${id}`
      ).text()}"></td>
      <td><input type="text" id="duration-${id}" value="${$(
        `#td-duration-${id}`
      ).text()}"></td>
      <td><input type="text" id="mode-${id}" value="${$(
        `#td-mode-${id}`
      ).text()}"></td>
      <td><input type="text" id="type-${id}" value="${$(
        `#td-type-${id}`
      ).text()}"></td>
      <td><input type="text" id="price-${id}" value="${$(
        `#td-price-${id}`
      ).text()}"></td>
      <td>
        <button class="btn btn-wide" onclick="updateCourse(${id})">Update</button><br>
        <button class="btn btn-wide" onclick="deleteCourse(${id})">Delete</button>
      </td>`
    );
  }
});
