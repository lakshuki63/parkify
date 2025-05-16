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
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="SPARKY"
  agent-id="15538dd3-8130-4a97-a1dc-26b4854c4880"
  language-code="en"
></df-messenger>
<div class="animated-bg"></div>

  <div class="top">
    <header class="hero">
      <!-- <div class="brand">
        <i class="fa-solid fa-car-side car-icon"></i>
        <h1 class="hero-title">Parkify</h1>
      </div>
      <p class="hero-subtitle">Smart, Effortless & Secure Parking, Anytime</p> -->
      <div class="logo-container">
    <img src="logo.png" class="logo-img" alt="Parkify Logo" />
  </div>
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
  <a href="../admin/admin_login.php " style=" text-decoration: none;"><button id="admin">ADMIN</button></a>

  <canvas id="particles"></canvas>
  <script src="particles.js"></script>

</body>
</html>