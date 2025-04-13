<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Parkify | User Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="userName.css" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1>User Registration</h1>
    <form action="save_form.php" method="POST" enctype="multipart/form-data">
      
      <div class="form-group">
        <label>Create a Username</label>
        <input type="text" name="Username">
      </div>

      <div class="form-row">
  <div class="form-group">
    <label>First Name</label>
    <input type="text" name="firstName">
  </div>

  <div class="form-group">
    <label>Last Name</label>
    <input type="text" name="lastName">
  </div>
</div>


      <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phoneNo">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="text" name="email">
      </div>

      <div class="form-group">
        <label>State</label>
        <input type="text" name="state">
      </div>

      <div class="form-group">
        <label>City</label>
        <input type="text" name="city">
      </div>

      <div class="form-group">
        <label>Address 1</label>
        <input type="text" name="address1">
      </div>

      <div class="form-group">
        <label>Address 2</label>
        <input type="text" name="address2">
      </div>

      <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" name="dob" placeholder="dd/mm/yy">
      </div>

      <div class="form-group">
        <label>Aadhar Number</label>
        <input type="text" name="aadharNumber">
      </div>

      <div class="form-group">
        <label>Insert Aadhar Card</label>
        <input type="file" name="aadharFile">
      </div>

      <div class="form-group">
        <label>Car Number</label>
        <input type="text" name="carNumber">
      </div>

      <div class="form-group">
        <label>Driving Licence Number</label>
        <input type="text" name="dlNumber">
      </div>

      <div class="form-group">
        <label>Driving Licence Picture</label>
        <input type="file" name="dlFile">
      </div>

      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>
