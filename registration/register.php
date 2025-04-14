<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Parkify Login</title>
  <link rel="stylesheet" href="reg.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Michroma&display=swap" rel="stylesheet">
</head>
<body>
  <div class="top">
    <header class="hero">
      <div class="brand">
        <i class="fa-solid fa-car-side car-icon"></i>
        <h1 class="hero-title">Parkify</h1>
      </div>
      <p class="hero-subtitle">Smart, Effortless & Secure Parking, Anytime</p>
    </header>
    
  </div>
  <div class="car-radar-container">
    <span class="radar-ping"></span>
    
  </div>
  
  

  <form action="ifok.php" method="POST">
    <div class="box">
      <label for="userName">USERNAME:</label>
      <input type="text" name="userName" id="userName" placeholder="Enter Username" />

      <br /><br /><br />

      <label for="password">PASSWORD:</label>
      <input type="password" name="password" id="password" placeholder="Enter Password"/>

      <p><a href="..\forgetpassword page\fg.php">Forgot Password?</a></p>

      <button id="submit">SUBMIT</button>
    </div>

    <p class="signup">
      <span class="new">New User?</span>
      <a href="..\userName\userName.php" class="signup-link">Sign Up Here</a>
      <br />

    </p>
    <span class="or">Or login using</span>
    <div class="icon">
      <a href="https://google.com/" target="_blank"><i class="fa-brands fa-google" id="google"></i></a>
      <a href="https://facebook.com/" target="_blank"><i class="fa-brands fa-facebook" id="facebook"></i></a>
      <a href="https://apple.com/" target="_blank"><i class="fa-brands fa-apple" id="apple"></i></a>
    </div>
  </form>
</body>
</html>