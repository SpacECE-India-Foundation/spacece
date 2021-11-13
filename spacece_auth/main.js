var BASE_URL = "http://localhost/spacece/spacece_auth/";

$(document).ready(function () {
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

  $(".register-form").submit(function (e) {
    if (!$(this).valid()) return false;

    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: BASE_URL + "register_action",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        const data = JSON.parse(response);
        if (data.status === "success") {
          window.location.href = BASE_URL + "login";
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
      url: BASE_URL + "login_action",
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
});
