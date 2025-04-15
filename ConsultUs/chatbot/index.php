
<?php  
header('location:../index.php');
exit();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Message</title>



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">




    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
<div class="text-center">
<img src="msg.jfif" class="img-fluid mb-4" alt="msg">
</div>
  <form action="claim.php" method="POST">
    <h1 class="h3 mb-3 fw-normal">Please enter your uid in format given in example to chat with consultant</h1>

    <div class="form-floating">
    
      <input type="text" class="form-control" id="floatingInput" placeholder="ex- uid123" name="name" >
      <br>
      <label for="floatingInput">ex- uid123</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>

  </body>
</html> 
