<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
</head>
<body>
  <form action="save_form.php" method="POST" enctype="multipart/form-data">
    <label>FIRST NAME :</label>
    <input type="text" name="firstName"><br><br>

    <label>LAST NAME :</label>
    <input type="text" name="lastName"><br><br>

    <label>PHONE NUMBER :</label>
    <input type="text" name="phoneNo"><br><br>

    <label>EMAIL:</label>
    <input type="text" name="email"><br><br>

    <label>STATE:</label>
    <input type="text" name="state"><br><br>

    <label>CITY:</label>
    <input type="text" name="city"><br><br>

    <label>ADDRESS 1:</label>
    <input type="text" name="address1"><br><br>

    <label>ADDRESS 2:</label>
    <input type="text" name="address2"><br><br>

    <label>Date of Birth:</label>
    <input type="text" name="dob"><br><br>

    <label>Aadhar Number :</label>
    <input type="text" name="aadharNumber"><br><br>

    <label>INSERT AADHAR CARD :</label>
    <input type="file" name="aadharFile"><br><br>

    <label>CAR NUMBER:</label>
    <input type="text" name="carNumber"><br><br>

    <label>Driving Licence Number:</label>
    <input type="text" name="dlNumber"><br><br>

    <label>Driving Licence PICTURE:</label>
    <input type="file" name="dlFile"><br><br>

    <button type="submit" >SUBMIT</button>
  </form>
</body>
</html>
