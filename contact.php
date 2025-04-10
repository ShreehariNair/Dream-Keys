<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        
        #map {
            height: 400px; 
            width: 400px; 
        }
        .error {
          color: red;
          font-size: 16px;
          text-align: center;
          margin-left: 10px;
          display: block; 
          margin-top: 5px;
        }

    </style>
</head>
<body>
    <header>
        <a href="#" class="logo">
            <img src="logonew.jpg">
        </a>
        <ul class="navbar">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="buy1.html">Buy</a></li>
            <li><a href="rent.html">Rent</a></li>
            <li><a href="sell.html">Sell</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <div class="h-btn">
        <!-- <a href="#" class="h-btn1">Login</a> -->
        <button onclick="show()" id="loginButton" class="h-btn1">Login</button>
        <button onclick="showregister()" id="signUpButton" class="h-btn2">Sign Up</button>
        <button onclick="onLogout()" id="logoutButton" class="h-btn1" style="display: none;">Logout</button>
        <div id="userProfile" class="user-circle" style="display: none;">
            <img id="profileImage" src="" alt="Profile Picture" style="display: none;">
        </div>
        <div class="menu-toggle">&#9776;</div>
    </header>

    <div class="contact-container">
        <form action="submit_form.php" method="POST" class="contact-left" onsubmit="return validateForm()">
            <div class="contact-left-title">
                <h2>Get In Touch</h2>
                <hr>
            </div>
            <input type="hidden" name="access_key" value="51e750fb-4c20-4db2-a35b-920f25ec3fff">
            <input type="text" id="Name" name="Name" placeholder="Your Name" class="contact-input"
            value="<?php echo $_SESSION['old_data']["Name"] ?? "";?>">
            <span class="error" id="nameError"><?php echo $_SESSION['errors']['name'] ?? ''; ?></span>
            <input type="email" id="Email" name="Email" placeholder="Your Email" class="contact-input" value="<?php echo $_SESSION['old_data']['Email'] ?? ''; ?>">
            <span class="error" id="emailError"><?php echo $_SESSION['errors']['email'] ?? ''; ?></span>
            <textarea name="Message" id="Message" placeholder="Your Message" class="contact-input"><?php echo $_SESSION['old_data']['Message'] ?? ''; ?></textarea>
            <span class="error" id="messageError"><?php echo $_SESSION['errors']['message'] ?? ''; ?></span>
            <button type="submit">Submit <img src="arrow_icon.png"></button>
        </form>
        <div class="contact-right">
          <img src="right_img.png">
        </div>
    </div>

    <footer>
        <h2>Our Location</h2>
        <div id="map"></div>
  </footer>
    <span class="footer-copy">
        &#169; DreamKeys. All rights reserved 
    </span>
    <div class="contact-content">
        <h4>Follow Us on</h4>
        <div class="icons">
            <a href="#"><i class='bx bxl-facebook' ></i></a>
            <a href="#"><i class='bx bxl-instagram' ></i></a>
            <a href="#"><i class='bx bxl-twitter' ></i></a>
        </div>
        </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([28.6139, 77.2090], 13); 

        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

       
        var marker = L.marker([28.6139, 77.2090]).addTo(map);
        marker.bindPopup("<b>We are here!</b><br>Visit us anytime.").openPopup();
    </script>
    <script>
        const header=document.querySelector("header")

window.addEventListener("scroll", function(){
    header.classList.toggle("sticky",window.scrollY>80)
});
    </script>
  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const navbar = document.querySelector('.navbar');

    menuToggle.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
</script>

<script>
    function validateForm() {
        let name = document.getElementById("Name").value.trim();
        let email = document.getElementById("Email").value.trim();
        let message = document.getElementById("Message").value.trim();

        
        let namePattern = /^[A-Za-z\s]+$/; 
        let emailPattern = /^[^\s@]+@(gmail|yahoo|outlook|hotmail|icloud)\.com$/i;

        
        let nameError = document.getElementById("nameError");
        let emailError = document.getElementById("emailError");
        let messageError = document.getElementById("messageError");

        
        nameError.textContent = "";
        emailError.textContent = "";
        messageError.textContent = "";

        let isValid = true;

    
        if (name === "") {
            nameError.textContent = "Please enter your name.";
            isValid = false;
        } else if (!namePattern.test(name)) {
            nameError.textContent = "Name should contain only letters and spaces.";
            isValid = false;
        }

        
        if (email === "") {
            emailError.textContent = "Please enter your email.";
            isValid = false;
        } else if (!emailPattern.test(email)) {
            emailError.textContent = "Email must be from gmail, yahoo, outlook, hotmail, or icloud.";
            isValid = false;
        }

        
        if (message.length < 10) {
            messageError.textContent = "Message must be at least 10 characters long.";
            isValid = false;
        }

        return isValid;
    }
</script>



</body>
</html>
<?php unset($_SESSION['errors']); unset($_SESSION['old_data']); ?>

