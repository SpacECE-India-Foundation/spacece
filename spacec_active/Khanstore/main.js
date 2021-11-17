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
        $("#select_user_products").append(data);
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
        Here #login is login form id and this form is available in Khanstore/index page
        from here input data is sent to Khanstore/login page
        if you get login_success string from Khanstore/login page means user is logged in successfully and window.location is 
        used to redirect user from home page to Khanstore/profile page
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

  $("body").delegate("#paymentInit", "click", function (event) {
    var longurl = $(this).attr("longurl");
    event.preventDefault();
    var name = $("#paymentInit").data("name");
    var email = $("#paymentInit").data("email");
    var mobile = $("#paymentInit").data("mobile");
    var total = $(".net_total").data("total");
    $.ajax({
      url: "payment.php",
      method: "POST",
      data: {
        paymentInit: 1,
        name: name,
        email: email,
        mobile: mobile,
        total: total,
      },
      headers: {
        accept: "application/json",
        "Access-Control-Allow-Origin": "*",
      },
      success: function (response) {
        var data = JSON.parse(response);
        alert(response);
        // console.log(data);
        if (data.success === false) {
          alert(data.message);
        } else {
          window.location.replace(data.payment_request.longurl);
        }
      },
    });
  });

  $("body").delegate("#refundInit", "click", function (event) {
    var longurl = $(this).attr("longurl");
    var trxId = $("#refundInit").data("trx-id");
    var refundAmount = $("#refundInit").data("refund-amt");
    event.preventDefault();
    $.ajax({
      url: "refund.php",
      method: "POST",
      data: { refundInit: 1, trx_id: trxId, refund_amt: refundAmount },
      headers: {
        accept: "application/json",
        "Access-Control-Allow-Origin": "*",
      },
      success: function (response) {
        console.log(response);
        // var data = JSON.parse(response);
        // console.log(data);
        // $("#refund_asking").html(data);
        // checkOutDetails();
        // window.location.replace(data.payment_request.longurl);
        // console.log(data);
        // console.log(data.payment_request.longurl);
      },
    });
  });

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
    $("#select_user_products").on("change", function (e) {
      var item = $("#select_user_products").val();

      e.preventDefault();
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { getItem: 1, item: item },
        success: function (data) {
          $("#selectItemPrice").val(data);
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
        var selectItem = row.find('#selectItemPrice').val();
      
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
    var item = update.find("#select_user_products").val();

    update.find("#select_user_products").val(item);
    var selectItem = update.find("#selectItemPrice").val();

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
        checkOutDetails is used to show cart item into Khanstore/Cart page
    */
  function checkOutDetails() {
    $(".overlay").show();
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { Common: 1, checkOutDetails: 1 },
      success: function (data) {
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
    var end_date = 0;
    var qty = 1;

    $(document).on("change", ".end_date", function () {
      end_date = $(".end_date").val();

      var row = $(this).parent().parent();
      var price = row.find(".price").val();

      var start_date = row.find(".start_date").val();

      // alert(start_date);
      const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
      var firstDate = new Date(start_date);
      var secondDate = new Date(end_date);

      var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));

      var selectItem = row.find("#selectItemPrice").val();
      var total_duration = diffDays;
      var statusInfo = row.find(".statusInfo").val();
      var deposit = row.find(".deposit").val();
      // alert(price);
      // alert($('.qty').val());
      //alert(total_duration);

      if (total_duration == 0) {
        deposit = 0;
        selectItem = 0;
      }
      if (statusInfo == "rent") {
        // alert($('.qty').val());
        var qty = $(".qty").val();
        if (total_duration > 1) {
          var total =
            price * $(".qty").val() * total_duration +
            parseInt(deposit) -
            (price * $(".qty").val() * 1 + parseInt(deposit));
          row.find(".total").val(total);
        } else {
          var total =
            price * $(".qty").val() * total_duration + parseInt(deposit);
          row.find(".total").val(total);
        }

        //alert(total);
      }
      if (statusInfo == "exchange") {
        var total = price * $(this).val() * total_duration - selectItem;
        row.find(".total").val(total);
      }
      if (statusInfo == "sale") {
        var total = price * $(this).val();
        row.find(".total").val(total);
      }
      if (statusInfo === "borrow") {
        //var total = (price * 0 * total_duration + 0)  -(deposit) ;
        var total = 0;
        // row.find(".total").val(total);
      }
      //  alert(total);
      $(".total").each(function () {
        net_total += $(this).val() - 0;
      });
      if (net_total === 0) {
        $(".net_total").hide();
        //$(".paypall").hide();
      } else {
        $(".net_total").html("Total  : " + net_total);
        $(".net_total").data("total", net_total);
      }
    });

    //  alert(net_total);

    $(document).on("change", ".qty", function () {
      // alert("tert");
      qty = $(".qty").val();
      var row = $(this).parent().parent();
      var price = row.find(".price").val();

      end_date = $(".end_date").val();

      var row = $(this).parent().parent();
      var price = row.find(".price").val();

      var start_date = row.find(".start_date").val();

      const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
      var firstDate = new Date(start_date);
      var secondDate = new Date(end_date);

      var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
      var total_duration = 1;
      if (diffDays > 0) {
        total_duration = diffDays;
      }

      var selectItem = row.find("#selectItemPrice").val();

      var statusInfo = row.find(".statusInfo").val();
      var deposit = row.find(".deposit").val();
      // $(".deposit").val(deposit);
      // alert(total_duration);
      deposit1 = deposit * qty;
      if (total_duration == 0) {
        deposit = 0;
        selectItem = 0;
      }
      if (statusInfo == "rent") {
        var total =
          price * $(this).val() * total_duration +
          parseInt(deposit1) -
          (price * 1 * total_duration + parseInt(deposit));
        row.find(".total").val(total);
      }
      if (statusInfo == "exchange") {
        var total = price * $(this).val() * total_duration - selectItem;
        row.find(".total").val(total);
      }
      if (statusInfo == "sale") {
        var total = price * $(this).val();
        row.find(".total").val(total);
      }
      if (statusInfo === "borrow") {
        //var total = (price * 0 * total_duration + 0)  -(deposit) ;
        var total = 0;
        // row.find(".total").val(total);
      }
      //alert(total);
      $(".total").each(function () {
        net_total += $(this).val() - 0;
      });

      if (net_total === 0) {
        $(".net_total").hide();
        /// $(".paypall").hide();
      } else {
        $(".net_total").html("Total  : " + net_total);
        $(".net_total").data("total", net_total);
      }
    });

    $("#select_user_products").on("change", function () {
      var row = $(this).parent().parent();
      var price = row.find(".price").val();

      var net_total = 0;
      var selectItem = row.find("#selectItemPrice").val();
      var total_duration = 1;
      var statusInfo = row.find(".statusInfo").val();
      var deposit = row.find(".deposit").val();
      var id = $(this).find(":selected").data("id");

      //alert(exp);
      //$('.total').val('0');

      $.ajax({
        method: "POST",
        data: {
          getPrice: 1,
          id: id,
        },
        url: "action.php",
        success: function (result) {
          //alert(price-result);

          var total = price - result;

          $(".total").val(total);
          $("#exp").val(result);
          $(".total").each(function () {
            // alert($(this).val());
            net_total += $(this).val() - 0;
          });
          $(".net_total").html("Total  : " + net_total);
          $(".net_total").data("total", net_total);
        },
      });

      // alert(price);
    });

    $(".qty").each(function () {
      var row = $(this).parent().parent();
      var price = row.find(".price").val();
      //alert(price);

      var selectItem = row.find("#selectItemPrice").val();
      var total_duration = 1;
      var statusInfo = row.find(".statusInfo").val();
      var deposit = row.find(".deposit").val();
      var exp = $("#exp").val();
      ///alert(exp);
      // if(statusInfo){
      //   deposit=0;
      // }else{
      //  deposit = row.find(".deposit").val();
      // }
      // // alert(total_duration)
      if (total_duration == 0) {
        deposit = 0;
        selectItem = 0;
      }
      if (statusInfo === "rent") {
        var total = price * $(this).val() * total_duration + parseInt(deposit);
        row.find(".total").val(total);
      }
      if (statusInfo === "exchange") {
        var total = price - exp;
        //alert(price);
        row.find(".total").val(total);
      }
      if (statusInfo === "sale") {
        var total = price * $(this).val();
        row.find(".total").val(total);
      }
      if (statusInfo === "borrow") {
        var total = price * 0 * total_duration + 0 - deposit;
        row.find(".total").val(0);
        //$('.total').val(0)
      }
      var net_total = 0;
      $(".total").each(function () {
        // alert($(this).val());
        net_total += $(this).val() - 0;
        // alert(total);
        //alert(net_total);
      });
      //alert(net_total);
      if (net_total === 0) {
        $(".net_total").hide();
        $("#paypall").hide();
      } else {
        $(".net_total").html("Total  : " + net_total);
        $(".net_total").data("total", net_total);
      }
    });

    // $(".total").each(function () {
    //   // alert($(this).val());
    //   net_total += $(this).val() - 0;

    // });

    //$(".net_total").html("Total  : " + net_total);
    // $(".net_total").data("total", net_total);
    //  alert(net_total);

    // if( net_total===0){
    //  $(".net_total").hide();
    // }else{
    //  $(".net_total").html("Total  : " + net_total);
    // $(".net_total").data("total", net_total);

    // }
  }

  //remove product from cart

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
