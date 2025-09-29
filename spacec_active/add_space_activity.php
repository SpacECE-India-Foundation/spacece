
<?php print_r($_POST);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta charset="UTF-8">
  <title>Add New Space Activity</title>
  <style>
   html, body {
  height: 100%;
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
background-color: #ddd !important;
  display: flex;
  flex-direction: column;
}

main {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}

    .form-card {
  background-color:rgb(235, 235, 235);
  padding: 80px 100px;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 700px;
  margin-top: 100px; 
}


    .form-card h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 32px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-size: 18px;
      color: #333;
    }

    .form-group input {
      width: 100%;
      padding: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    .form-group input:focus {
      border-color: #ffa500;
      outline: none;
    }

    .form-group.invalid input {
      border-color: black;
      color: red;
    }

    .error-message {
      color: black;
      font-size: 16px;
      margin-top: 5px;
      display: none;
    }
    .error-message.empty-message {
      display: none;
    }

    .form-group.invalid .error-message {
      display: block;
    }

    .submit-btn {
      width: 100%;
      background-color: orange;
      color: white;
      border: none;
      padding: 16px;
      border-radius: 6px;
      font-size: 18px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .submit-btn:hover {
      background-color: #e69500;
    }
  </style>
</head>
<body>
 
    <header>
      <?php
        include_once './header_local.php';
        include_once '../common/header_module.php';
      ?>    
    </header>
    <main>
      <div class="form-card">
        <h2>Add New Space Activity</h2>
        <form id="activityForm" name="activityForm"  method="POST" action="save_space_activity.php" novalidate>
          <div class="form-group" id="group-activity_id">
            <label for="activity_id">Activity ID</label>
            <input type="number" id="activity_id" name="activity_id" required placeholder=" ">
            <div class="error-message empty-message">Please fill out this field.</div>
            <div class="error-message">Please enter a valid Activity ID (number only).</div>
          </div>

          <div class="form-group" id="group-activity_name">
            <label for="activity_name">Activity Name</label>
            <input type="text" id="activity_name" name="activity_name"
                   pattern="[A-Za-z\s]{3,50}" 
                   placeholder=" "
                   required>
            <div class="error-message empty-message">Please fill out this field.</div>
            <div class="error-message">Only letters and spaces, 3–50 characters.</div>
          </div>

          <div class="form-group" id="group-date">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>
            <div class="error-message empty-message">Please fill out this field.</div>
          </div>

          <div class="form-group" id="group-time">
            <label for="time">Time</label>
            <input type="time" id="time" name="time" required>
            <div class="error-message empty-message">Please fill out this field.</div>
          </div>

          <div class="form-group" id="group-status">
          <label for="status">Status</label>
          <input type="text" id="status" name="status" 
                placeholder=" " 
                required
                pattern="scheduled|ongoing|completed">
          <div class="error-message empty-message">Please fill out this field.</div>
          <div class="error-message">Enter: Scheduled, Ongoing, or Completed.</div>
        </div>

          <br>
          <button type="click" id = "btn" name ="btn" class="submit-btn">Submit</button>
        </form>
      </div>
    </main>
    <footer>
      <?php include_once '../common/footer_module.php'; ?>
    </footer>
  

  <script>
  const form = document.getElementById('activityForm');
  const fields = ['activity_id', 'activity_name', 'date', 'time', 'status'];

  btn.addEventListener('click', function (e) {
    alert('in func');
    let valid = true;

    fields.forEach(id => {
      const input = document.getElementById(id);
      const group = document.getElementById('group-' + id);
      const emptyMsg = group.querySelector('.empty-message');
      const invalidMsg = group.querySelector('.error-message:not(.empty-message)');

      if (input.value.trim() === "") {
        group.classList.add('invalid');
        emptyMsg.style.display = 'block';
        if(invalidMsg) invalidMsg.style.display = 'none';
        valid = false;
      } else if (!input.checkValidity()) {
        
        group.classList.add('invalid');
        emptyMsg.style.display = 'none';
        if(invalidMsg) invalidMsg.style.display = 'block';
        valid = false;
      } else {
        group.classList.remove('invalid');
        emptyMsg.style.display = 'none';
        if(invalidMsg) invalidMsg.style.display = 'none';
      }
    });
    thisform.action="save_space_activity.php";
    //thisform.submit();
    if (!valid) e.preventDefault();
    
  });
  </script>

</body>
</html>
