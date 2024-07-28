$(document).ready(function () {
  $(".consultant_details").hide();

  $("#edit").click(function () {
    $("#js-name input").prop("disabled", false);
    $("#js-email input").prop("disabled", false);
    $("#js-phone input").prop("disabled", false);
    $("#change_password").show();
    $("#edit").hide();
    $("#update").show();
    $(".file-input").show();
  });

  $("#change_password").click(function () {
    $("#js-password").show();
    $("#js-confirm-password").show();
    $("#js-password input").prop("disabled", false);
    $("#js-confirm-password input").prop("disabled", false);
    $("#change_password").hide();
  });
  $('#c_available_days').selectpicker();
  var selectedItem='';
  $('#c_available_days').change(function () {
    selectedItem= $('#c_available_days').val();
    
});
  // Registration form validation name, email, password, cpassword, indian phone number, image with regex
  $(".register-form").validate({
    error: function (label) {
      $(this).addClass("error");
    },
    rules: {
      name: {
        required: true,
        minlength: 3,
        maxlength: 20,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 20,
      },
      cpassword: {
        required: true,
        equalTo: "#password",
      },
      phone: {
        required: true,
        minlength: 10,
        maxlength: 10,
        digits: true,
      },
      image: {
        required: true,
        extension: "jpg|jpeg|png|gif",
      },
      user_type: {
        required: true,
      },
      c_categories: {
        required: true,
      },
      c_office: {
        required: true,
      },
      c_from_time: {
        required: true,
      },
      c_to_time: {
        required: true,
      },
      c_language: {
        required: true,
      },
      c_fee: {
        required: true,
      },
      c_available_from: {
        required: true,
      },
      c_available_to: {
        required: true,
      },
      c_qualification: {
        required: true,
      },
      c_available_days:{
        required: true,
      }

    },
    messages: {
      name: {
        required: "Please enter your name",
        minlength: "Name must be at least 3 characters long",
        maxlength: "Name must be at most 20 characters long",
      },
      email: {
        required: "Please enter your email",
        email: "Please enter a valid email address",
      },
      password: {
        required: "Please enter your password",
        minlength: "Password must be at least 6 characters long",
        maxlength: "Password must be at most 20 characters long",
      },
      cpassword: {
        required: "Please enter your password again",
        equalTo: "Password doesn't match",
      },
      phone: {
        required: "Please enter your phone number",
        minlength: "Phone number must be at least 10 digits long",
        maxlength: "Phone number must be at most 10 digits long",
        digits: "Please enter a valid phone number",
      },
      image: {
        required: "Please upload your image",
        extension: "Please upload a valid image",
      },
      user_type: {
        required: "Please select user type",
      },
      c_categories: {
        required: "Please select categories",
      },
      c_office: {
        required: "Please enter office address",
      },
      c_from_time: {
        required: "Please enter 'From' time",
      },
      c_to_time: {
        required: "Please enter 'To' time",
      },
      c_language: {
        required: "Please enter language",
      },
      c_fee: {
        required: "Please enter fees",
      },
      // c_available_from: {
      //   required: "Please enter 'From' availability day",
      // },
      // c_available_to: {
      //   required: "Please enter 'To' availability day",
      // },
      c_qualification: {
        required: "Please enter qualification",
      },
      c_available_days:{
        required: "Please enter 'To' availability day",
      }
    },
  });

  // Login form validation email and password with regex
  $(".login-form").validate({
    error: function (label) {
      $(this).addClass("error");
    },
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
      email: {
        required: "Please enter your email",
        email: "Please enter a valid email address",
      },
      password: {
        required: "Please enter your password",
      },
    },
  });

  // Profile edit validation email and password with regex
  $(".profile-form").validate({
    error: function (label) {
      $(this).addClass("error");
    },
    rules: {
      name: {
        required: true,
        minlength: 3,
        maxlength: 20,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 20,
      },
      cpassword: {
        required: true,
        equalTo: "#password",
      },
      phone: {
        required: true,
        minlength: 10,
        maxlength: 10,
        digits: true,
      },
      image: {
        required: true,
        extension: "jpg|jpeg|png|gif",
      },
      user_type: {
        required: true,
      },
      c_categories: {
        required: true,
      },
      c_office: {
        required: true,
      },
      c_from_time: {
        required: true,
      },
      c_to_time: {
        required: true,
      },
      c_language: {
        required: true,
      },
      c_fee: {
        required: true,
      },
      c_available_from: {
        required: true,
      },
      c_available_to: {
        required: true,
      },
      c_qualification: {
        required: true,
      },
    },
    messages: {
      name: {
        required: "Please enter your name",
        minlength: "Name must be at least 3 characters long",
        maxlength: "Name must be at most 20 characters long",
      },
      email: {
        required: "Please enter your email",
        email: "Please enter a valid email address",
      },
      password: {
        required: "Please enter your password",
        minlength: "Password must be at least 6 characters long",
        maxlength: "Password must be at most 20 characters long",
      },
      cpassword: {
        required: "Please enter your password again",
        equalTo: "Password doesn't match",
      },
      phone: {
        required: "Please enter your phone number",
        minlength: "Phone number must be at least 10 digits long",
        maxlength: "Phone number must be at most 10 digits long",
        digits: "Please enter a valid phone number",
      },
      image: {
        required: "Please upload your image",
        extension: "Please upload a valid image",
      },
      user_type: {
        required: "Please select user type",
      },
      c_categories: {
        required: "Please select categories",
      },
      c_office: {
        required: "Please enter office address",
      },
      c_from_time: {
        required: "Please enter 'From' time",
      },
      c_to_time: {
        required: "Please enter 'To' time",
      },
      c_language: {
        required: "Please enter language",
      },
      c_fee: {
        required: "Please enter fees",
      },
      // c_available_from: {
      //   required: "Please enter 'From' availability day",
      // },
      // c_available_to: {
      //   required: "Please enter 'To' availability day",
      // },
      c_qualification: {
        required: "Please enter qualification",
      },
      c_available_days:{
        required: "Please enter 'To' availability day",
      }
    },
  });

  $(".register-form").submit(function (e) {
    if (!$(this).valid()) return false;

    e.preventDefault();

    var formData = new FormData(this);
    
  
  formData.append("selectedItem",selectedItem);

    $.ajax({
      type: "POST",
      url: "./register_action.php",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        const data = JSON.parse(response);
        if (data.status === "success") {
          Toastify({
            text: data.message,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            className: "success",
            style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
          }).showToast();
          setTimeout(function () {
            window.location.href = "./login.php";
          }, 3000);
        }
        if (data.status === "error") {
          Toastify({
            text: data.message,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            className: "error",
            style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
          }).showToast();
        }
      },
    });
  });

  $(".login-form").submit(function (e) {
    if (!$(this).valid()) return false;

    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "./login_action.php",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        const data = JSON.parse(response);
        if (data.status === "success") {
          window.location.href = data.redirect_url;
        } else {
          Toastify({
            text: data.message,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            className: "error",
            style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
          }).showToast();
        }
      },
    });
  });

  $("#user_type").change(function () {
    var type = $("#user_type").val();
    if (type == "consultant") {
      $(".consultant_details").show();
    } else {
      $(".consultant_details").hide();
    }
  });
});
