<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="forget.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >
    <div class="top">
    <header class="hero">
        <h1 class="hero-title"><u> RESET Password</u></h1>
        <p class="hero-subtitle"></p>
      </header>
    </div>
    <form >
        <div class="box">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
         <br> <br><br>
        <label for="captcha">CAPTCHA CODE:</label>
        <div class="captcha-box" id="captcha"></div>
        <!-- <button onclick="generateCaptcha()"><i class="fa-solid fa-rotate"></i></button> -->
        <div class="icon"><i class="fa-solid fa-rotate" onclick="generateCaptcha()"></i></div>

        
        <br>
        <br><br>
        <label for="">enter:</label>
        
        <input type="text" name="captchaInput" id="captchaInput">
        <br><br><br>

        <button id="submit" >Submit</button>
        <p id="message"></p>


        </div>

    <script src="fg.js"></script>
        </form>
    
</body>
</html>