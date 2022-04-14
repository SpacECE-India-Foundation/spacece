$(document).ready(function () {
  // var now = new Date(); now.setDate(now.getDate() + 15
  cat();
  brand();
  product();
  getItem();
  function loadProduct() {
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { userSelectProduct: 1 },
      success: function (data) {
        $(".select_user_products").append(data);
      },
    });
  }
  //user_product();
  //cat() is a funtion fetching category record from database whenever page is load
  function cat() {
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { category: 1 },
      success: function (data) {
        $("#get_category").html(data);
      },
    });
  }
  //brand() is a funtion fetching brand record from database whenever page is load
  function brand() {
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { brand: 1 },
      success: function (data) {
        $("#get_brand").html(data);
      },
    });
  }
  //product() is a funtion fetching product record from database whenever page is load
  function product() {
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { getProduct: 1 },
      success: function (data) {
        $("#get_product").html(data);
      },
    });
  }
  /*function user_product()
        {
            $.ajax({
                url : "action",
                method: "POST",
                data  : {getUserProduct:1},
                success : function(data){
                    $.each(data,function(key,value){
                        $("#user_products").append("<option>"+);
                    });
                  
                }
            })
        }*/
  /*  when page is load successfully then there is a list of categories when user click on category we will get category id and 
            according to id we will show products
        */

  $("#search").keypress(function () {
    var text = $("#search").val();

    $("#search_items").empty();
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { get_seleted_data: 1, text: text },

      success: function (data) {
        $("#search_items").append(data);
      },
    });
  });

  $("#search").change(function () {
    var text = $("#search").val();
    //$("#search_items").hide();
    //alert(text);
    //alert("Changed");
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { get_seleted_Filter: 1, text: text },

      success: function (data) {
        //alert(data);
        $("#get_product").html(data);
        if ($("body").width() < 480) {
          $("body").scrollTop(683);
        }
        // $("#search_items").append(data);
      },
    });
  });

  $("body").delegate(".category", "click", function (event) {
    $("#get_product").html("<h3>Loading...</h3>");
    event.preventDefault();
    var cid = $(this).attr("cid");

    $.ajax({
      url: "action.php",
      method: "POST",
      data: { get_seleted_Category: 1, cat_id: cid },
      success: function (data) {
        $("#get_product").html(data);
        if ($("body").width() < 480) {
          $("body").scrollTop(683);
        }
      },
    });
  });

  /*  when page is load successfully then there is a list of brands when user click on brand we will get brand id and 
            according to brand id we will show products
        */
  $("body").delegate(".selectBrand", "click", function (event) {
    event.preventDefault();
    $("#get_product").html("<h3>Loading...</h3>");
    var bid = $(this).attr("bid");

    $.ajax({
      url: "action.php",
      method: "POST",
      data: { selectBrand: 1, brand_id: bid },
      success: function (data) {
        $("#get_product").html(data);
        if ($("body").width() < 480) {
          $("body").scrollTop(683);
        }
      },
    });
  });
  /*
            At the top of page there is a search box with search button when user put name of product then we will take the user 
            given string and with the help of sql query we will match user given string to our database keywords column then matched product 
            we will show 
        */
  $("#search_btn").click(function (e) {
    e.preventDefault();
    $("#get_product").html("<h3>Loading...</h3>");
    var text = $("#search").val();
    if (text != "") {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { search: 1, text: text },
        success: function (data) {
          console.log(data);
          $("#get_product").html(data);
          if ($("body").width() < 480) {
            $("body").scrollTop(683);
          }
        },
      });
    }
  });
  //end

  /*
            Here #login is login form id and this form is available in index page
            from here input data is sent to login.php page
            if you get login_success string from login.php page means user is logged in successfully and window.location is 
            used to redirect user from home page to profile page
        */
  $("#login").on("submit", function (event) {
    event.preventDefault();
    $(".overlay").show();
    $.ajax({
      url: "login.php",
      method: "POST",
      data: $("#login").serialize(),
      success: function (data) {
        if (data == "login_success") {
          window.location.href = "profile.php";
        } else if (data == "cart_login") {
          window.location.href = "cart.php";
        } else {
          $("#e_msg").html(data);
          $(".overlay").hide();
        }
      },
    });
  });
  //end

  //Get User Information before checkout
  $("#signup_form").on("submit", function (event) {
    event.preventDefault();
    $(".overlay").show();
    $.ajax({
      url: "register.php",
      method: "POST",
      data: $("#signup_form").serialize(),
      success: function (data) {
        $(".overlay").hide();
        if (data == "register_success") {
          window.location.href = "index.php";
        } else {
          $("#signup_msg").html(data);
        }
      },
    });
  });
  //Get User Information before checkout end here

  //Add Product into Cart
  $("body").delegate("#product", "click", function (event) {
    var targetDate = new Date();
    targetDate.setDate(targetDate.getDate() + 15);

    // So you can see the date we have created

    var dd = targetDate.getDate();
    var mm = targetDate.getMonth() + 1; // 0 is January, so we must add 1
    var yyyy = targetDate.getFullYear();

    var end_date = yyyy + "-" + mm + "-" + dd;
    //alert(end_date);
    // So you can see the output
    //alert(dateString);

    var pid = $(this).attr("pid");
    event.preventDefault();
    $(".overlay").show();
    var row = $(this).parent().parent();
    var status = row.find(".status").val();

    $.ajax({
      url: "action.php",
      method: "POST",
      data: { addToCart: 1, proId: pid, status: status, end_date: end_date },
      success: function (data) {
        // console.log(data);
        count_item();
        getCartItem();
        loadProduct();
        $("#product_msg").html(data);
        $(".overlay").hide();
      },
    });
  });
  //Add Product into Cart End Here
  //Count user cart items funtion
  count_item();
  function count_item() {
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { count_item: 1 },
      success: function (data) {
        $(".badge").html(data);
      },
    });
  }
  //Count user cart items funtion end

  //Fetch Cart item from Database to dropdown menu
  getCartItem();
  function getCartItem() {
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { Common: 1, getCartItem: 1 },
      success: function (data) {
        $("#cart_product").html(data);
      },
    });
  }

  //Fetch Cart item from Database to dropdown menu
  function getItem() {
    $(".select_user_products").on("change", function (e) {
      var item = $(".select_user_products").val();

      e.preventDefault();
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { getItem: 1, item: item },
        success: function (data) {
          $(".selectItemPrice").val(data);
          console.log("getitem", $(".selectItemPrice").val());
        },
      });
    });
  }

  /*
            Whenever user change qty we will immediate update their total amount by using keyup funtion
            but whenever user put something(such as ?''"",.()''etc) other than number then we will make qty=1
            if user put qty 0 or less than 0 then we will again make it 1 qty=1
            ('.total').each() this is loop funtion repeat for class .total and in every repetation we will perform sum operation of class .total value 
            and then show the result into class .net_total
        */
  /*$("body").delegate(".qty","keyup",function(event){
            event.preventDefault();
            var row = $(this).parent().parent();
            var price = row.find('.price').val();
            var qty = row.find('.qty').val();
            var total_duration = row.find('.total_duration').val();
            var selectItem = row.find('.selectItemPrice').val();
          
            if (isNaN(selectItem)) {
                alert("selectI");
            };
          
            if (isNaN(qty)) {
                qty = 1;
            };
            if (qty < 1) {
                qty = 1;
            };
            var total = (price * qty*total_duration)-selectItem;
          
            row.find('.total').val(total);
            var net_total=0;
            $('.total').each(function(){
                net_total += ($(this).val()-0);
            })
            $('.net_total').html("Total k: $ " +net_total);
    
        })*/
  //Change Quantity end here

  /*
            whenever user click on .remove class we will take product id of that row 
            and send it to action to perform product removal operation
        */
  $("body").delegate(".remove", "click", function (event) {
    var remove = $(this).parent().parent().parent();
    var remove_id = remove.find(".remove").attr("remove_id");
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { removeItemFromCart: 1, rid: remove_id },
      success: function (data) {
        $("#cart_msg").html(data);
        checkOutDetails();
      },
    });
  });
  /*
            whenever user click on .update class we will take product id of that row 
            and send it to action to perform product qty updation operation
    
    
    
    
        */

  $("body").delegate(".update", "click", function (event) {
    event.preventDefault();

    var start_date = update.find(".start_date").val();

    var update = $(this).parent().parent().parent();
    var update_id = update.find(".update").attr("update_id");
    var qty = update.find(".qty").val();
    var price = update.find(".price").val();

    var total_duration = update.find(".total_duration").val();
    var item = update.find(".select_user_products").val();

    update.find(".select_user_products").val(item);
    var selectItem = update.find(".selectItemPrice").val();

    $.ajax({
      url: "action.php",
      method: "POST",
      data: {
        updateCartItem: 1,
        update_id: update_id,
        qty: qty,
        start_date: start_date,
        end_date: end_date,
        item: item,
        selectItem: selectItem,
      },
      success: function (data) {
        $("#cart_msg").html(data);
        checkOutDetails();
      },
    });
  });

  checkOutDetails();
  getItem();
  net_total();
  /*
            checkOutDetails() function work for two purposes
            First it will enable php isset($_POST["Common"]) in action page and inside that
            there is two isset funtion which is isset($_POST["getCartItem"]) and another one is isset($_POST["checkOutDetials"])
            getCartItem is used to show the cart item into dropdown menu 
            checkOutDetails is used to show cart item into Cart page
        */
  function checkOutDetails() {
    $(".overlay").show();
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { Common: 1, checkOutDetails: 1 },
      success: function (data) {
        // alert("Hello");
        $(".overlay").hide();
        $("#cart_checkout").html(data);
        loadProduct();
        getItem();
        net_total();
      },
    });
  }

  /*
            net_total function is used to calcuate total amount of cart item
        */

  function net_total() {
    var net_total = 0;

    $(document).on("change", ".end_date", function () {
      var row = $(this).parent().parent();

      var selectItem = row.find(".selectItemPrice").val();

      var statusInfo = row.find(".statusInfo").val();

      totalCalc(row, statusInfo, selectItem);

      $(".total").each(function () {
        net_total += $(this).val() - 0;
      });

      if (net_total === 0) {
        $(".net_total").hide();
      } else {
        $(".net_total").html("Total: ₹" + net_total);
      }
    });

    let a = 0;
    let b = 0;
    let c = 0;
    let d = 0;

    $(document).on("change", ".qty", function () {
      console.log("change qty - ", ++a);
      var row = $(this).parent().parent();

      var selectItem = row.find(".selectItemPrice").val();

      var statusInfo = row.find(".statusInfo").val();

      totalCalc(row, statusInfo, selectItem);

      $(".total").each(function () {
        console.log("each total1 - ", ++b);
        net_total += $(this).val() - 0;
        // console.log("net_total", net_total);
      });

      $(".net_total").html("Total: ₹" + net_total);
    });

    $(document).on("change", ".select_user_products", function () {
      var row = $(this).parent().parent();

      var selectItem = row.find(".selectItemPrice").val();

      var statusInfo = row.find(".statusInfo").val();

      totalCalc(row, statusInfo, selectItem);

      $(".total").each(function () {
        net_total += $(this).val() - 0;
      });

      $(".net_total").html("Total: ₹" + net_total);
    });

    $(".qty").each(function () {
      console.log("each qty - ", ++c);
      var row = $(this).parent().parent();

      var selectItem = row.find(".selectItemPrice").val();

      var statusInfo = row.find(".statusInfo").val();

      totalCalc(row, statusInfo, selectItem);

      $(".total").each(function () {
        console.log("each total2 - ", ++d);
        net_total += $(this).val() - 0;
      });

      $(".net_total").html("Total: ₹" + net_total);
    });
  }
  //Difference in days

  function diffDays(start_date, end_date) {
    const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
    var firstDate = new Date(start_date);
    var secondDate = new Date(end_date);

    var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
    var total_duration = 0;
    if (diffDays > 0) {
      total_duration = diffDays;
    }
    return total_duration;
  }

  // Calculate Total Price

  function totalCalc(row, statusInfo, selectItem) {
    var total = 0;

    var start_date = row.find(".start_date").val();
    var end_date = row.find(".end_date").val();

    // console.log(row.find(".selectItemPrice"));
    // console.log(row.find(".selectItemPrice").val());

    var total_duration = diffDays(start_date, end_date);

    var price = row.find(".price").val();
    var qty = $(".qty").val();
    var deposit = row.find(".deposit").val();

    if (statusInfo == "rent") {
      if (!end_date) {
        end_date = new Date(start_date);
        end_date.setDate(end_date.getDate() + 1);
        var d = new Date(end_date);
        row
          .find(".end_date")
          .val(
            d.getFullYear() +
              "-" +
              ("0" + (d.getMonth() + 1)).slice(-2) +
              "-" +
              ("0" + d.getDate()).slice(-2)
          );
      }

      var total_duration = diffDays(start_date, end_date);

      total = price * qty * total_duration + parseInt(deposit) * qty;
    }

    if (statusInfo == "purchase") {
      // console.log("price", price);
      // console.log("qty", qty);
      // console.log("deposit", deposit);

      // console.log("selectItem in purchase", selectItem);
      total = price * qty - selectItem;
    }

    if (statusInfo === "borrow") {
      if (!end_date) {
        end_date = new Date(start_date);
        end_date.setDate(end_date.getDate() + 15);
        var d = new Date(end_date);
        row
          .find(".end_date")
          .val(
            d.getFullYear() +
              "-" +
              ("0" + (d.getMonth() + 1)).slice(-2) +
              "-" +
              ("0" + d.getDate()).slice(-2)
          );
      }
    }

    row.find(".total").val(total);
  }

  page();
  function page() {
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { page: 1 },
      success: function (data) {
        $("#pageno").html(data);
      },
    });
  }
  $("body").delegate("#page", "click", function () {
    var pn = $(this).attr("page");
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { getProduct: 1, setPage: 1, pageNumber: pn },
      success: function (data) {
        $("#get_product").html(data);
      },
    });
  });
});
