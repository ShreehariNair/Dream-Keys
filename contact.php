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
      <a href="index.html" class="logo">
        <img src="assets/logo.png" width="120" alt="logo" height="100" class="logo-img">
      </a>
      <nav class="navbar">
        <div class="link">
          <a href="home.php" class="nav-link">Home</a>
        </div>
        <div class="link">
          <a href="about.html" class="nav-link">About us</a>
        </div>
        <div class="link">
          <a href="index.php" class="nav-link">Buy</a>
        </div>
        <div class="link">
          <a href="sell.php" class="nav-link">Sell</a>
        </div>
        <div class="link">
          <a href="contact.html" class="nav-link">Contact Us</a>
        </div>
      </nav>
      <?php
    $username = '';
    $password = '';
    $email = '';
    $error = '';
    
    if(isset($_SESSION['status'])){
        echo $_SESSION['status'];
        $_SESSION['status'] = '';
    }
    if(isset($_POST['signout']) && $_POST['signout'] == 'true'){
        session_reset();
        session_destroy();
        header('Location: '.'index.php');
    }
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        
      echo '<form method="POST" action="index.php"><div class="h-btn">
      <div id="userProfile" class="user-circle"><i class="ph-fill ph-user-circle"></i></div>
      <input type="hidden" name="signout" value="true"><button id="logoutButton" class="h-btn1">Logout</button></div></form>';

    } else {
    echo '<div class="h-btn user">
    <button onclick="show()" id="loginButton" class="h-btn1">Login</button>
    <button onclick="showregister()" id="signUpButton" class="h-btn2">Sign Up</button>
    </div>
    
    <div id="overlay" style="display: none;">
            <div class="credentials">
            <div class="login" style="display: none;">
            <form class="form" method="POST" action="index.php">
            <button onclick="hide()" id="close-login"><i class="ph ph-x"></i></button>
            <h1 class="head1">LOGIN</h1>
            <label class="mylabel">Username</label>
            <input type="text" class="myinput" name="username" id="username" required>
            <label class="mylabel">Password</label>
            <input type="password" class="myinput" name="pw" id="password" required>
            <button id="mybtn1" class="mybutton">Login</button>
            </form>
            </div>
            <div class="register" style="display: none;">
            <form class="form" method="POST" action="index.php">
            <button onclick="hide()" id="close-register"><i class="ph ph-x"></i></button>
                        <h1 class="head1">SIGN UP</h1>
                        <label class="mylabel">Username</label>
                        <input type="text" class="myinput" name="username" id="user" required>
                        <label class="mymaillabel">Email Id</label>
                        <input type="email" class="myinput" name="email" id="email" required>
                        <label class="mylabel">Password</label>
                        <input type="password" class="myinput" name="pw" id="pw" required>
                        <button id="mybtn2" class="mybutton">Create Account</button>
                        </form>
                        </div>
                        </div>
                        </div>';
    }
                        if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                            echo '<script>                            
                                // const username=document.getElementById("usernameInput")?.value||"User";
                                const userProfile=document.getElementById("userProfile");
                                const profileImage = document.getElementById("profileImage");
                                
                                const profilePictureURL = "https://png.pngtree.com/png-clipart/20191121/original/pngtree-user-icon-png-image_5097430.jpg"; 
                                userProfile.style.display = "flex";</script>';
        } else if(isset($_POST['username']) && isset($_POST['pw']) && isset($_POST['email'])){
            global $username,$password; 
            $username = $_POST['username'];
            $password = $_POST['pw'];
            $email = $_POST['email'];
            $s = "localhost";
            $u = "DBA";
            $p = "dba";
            $db = "dream keys";

            $user = [];
            $conn = mysqli_connect($s,$u,$p,$db);
            $query = $conn -> prepare("Select * from users where user_id = ? LIMIT 1;");
            $query -> bind_param('s',$username);
            $query -> execute();
            $result = $query -> get_result();
            while($row = $result -> fetch_assoc()){
                array_push($user,$row);
            };
            $query -> close();
            $conn->close();
            if(!empty($user) && $username == $user[0]['user_id']){
                $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>User Id already exists</p></div>';
            } else {
                $s = "localhost";
                $u = "DBA";
                $p = "dba";
                $db = "dream keys";
                global $username,$password,$email;
                $hashed_pw = password_hash($password,PASSWORD_DEFAULT);
                $conn = mysqli_connect($s,$u,$p,$db);
                $query = $conn -> prepare("Insert into users (user_id,hashed_password,email) VALUES (?,?,?)");
                $query -> bind_param('sss',$username,$hashed_pw,$email);
                $query -> execute();
                $query -> close();
                $conn->close();
                $_SESSION['status'] = '<div class="message"><i class="ph ph-check-circle"></i><p>User Registered successfully</p></div>';
            }
            }    
        else if(isset($_POST['username']) && isset($_POST['pw']) && !isset($_POST['email'])){
        
        global $username,$password; 
        $username = $_POST['username']; 
        $password = $_POST['pw'];
        $s = "localhost";
        $u = "DBA";
        $p = "dba";
        $db = "dream keys";

        $user = [];
        $conn = mysqli_connect($s,$u,$p,$db);
        $query = $conn -> prepare("Select * from users where user_id = ?");
        $query -> bind_param('s',$username);
        $query -> execute();
        $result = $query -> get_result();
        while($row = $result -> fetch_assoc()){
            array_push($user,$row);
        };
        $query -> close();
        $conn->close();

        if(!empty($user) && password_verify($password,$user[0]['hashed_password'])){
            $_SESSION['username'] = $user[0]['user_id'];
            $_SESSION['password'] = $user[0]['hashed_password'];
                $_SESSION['status'] = '<div class="message"><i class="ph-fill ph-check-circle"></i><p> You have successfully logged in</p></div>';
                header('Location: '.'index.php');
        } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
            header('Location: '.'index.php');
            
            
}
}
?>
      <button class="menu-btn"></button>
        <nav class="mobile-nav">
          <button class="close-btn"></button>
          <div class="mobile-link">
            <i class='bx bx-home nav-icon'></i>
            <a href="index.php" class="mobile-nav-link">Home</a>
          </div>
          <div class="mobile-link">
            <i class="ph ph-building nav-icon"></i>
            <a href="about.html" class="mobile-nav-link">About us</a>
          </div>
          <div class="mobile-link">
            <i class="ph ph-money nav-icon"></i>
            <a href="index.php" class="mobile-nav-link">Buy</a>
          </div>
          <div class="mobile-link">
            <i class="ph ph-key nav-icon"></i>
            <a href="sell.php" class="mobile-nav-link">Sell</a>
          </div>
          <div class="mobile-link">
            <i class="ph ph-phone nav-icon"></i>
            <a href="contact.php" class="mobile-nav-link">Contact Us</a>
          </div>
          <?php
    $username = '';
    $password = '';
    $email = '';
    $error = '';
    
    if(isset($_SESSION['status'])){
        echo $_SESSION['status'];
        $_SESSION['status'] = '';
    }
    if(isset($_POST['signout']) && $_POST['signout'] == 'true'){
        session_reset();
        session_destroy();
        header('Location: '.'index.php');
    }
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        
      echo '<form method="POST" action="index.php"><div class="mobile-h-btn">
      <div id="userProfile" class="user-circle"><i class="ph-fill ph-user-circle" style="color:#121b25"></i></div>
      <input type="hidden" name="signout" value="true"><button id="logoutButton" class="mobile-h-btn1">Logout</button>
      </div></form>';
    } else {
    echo '<div class="mobile-h-btn">
    <button onclick="show()" id="loginButton" class="mobile-h-btn1">Login</button>
    <button onclick="showregister()" id="signUpButton" class="mobile-h-btn2">Sign Up</button>
    </div>
    
    <div id="overlay" style="display: none;">
            <div class="credentials">
            <div class="login" style="display: none;">
            <form class="form" method="POST" action="index.php">
            <button onclick="hide()" id="close-login"><i class="ph ph-x"></i></button>
            <h1 class="head1">LOGIN</h1>
            <label class="mylabel">Username</label>
            <input type="text" class="myinput" name="username" id="username" required>
            <label class="mylabel">Password</label>
            <input type="password" class="myinput" name="pw" id="password" required>
            <button id="mybtn1" class="mybutton">Login</button>
            </form>
            </div>
            <div class="register" style="display: none;">
            <form class="form" method="POST" action="index.php">
            <button onclick="hide()" id="close-register"><i class="ph ph-x"></i></button>
                        <h1 class="head1">SIGN UP</h1>
                        <label class="mylabel">Username</label>
                        <input type="text" class="myinput" name="username" id="user" required>
                        <label class="mymaillabel">Email Id</label>
                        <input type="email" class="myinput" name="email" id="email" required>
                        <label class="mylabel">Password</label>
                        <input type="password" class="myinput" name="pw" id="pw" required>
                        <button id="mybtn2" class="mybutton">Create Account</button>
                        </form>
                        </div>
                        </div>
                        </div>';
    }
                        if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                            echo '<script>                            
                                // const username=document.getElementById("usernameInput")?.value||"User";
                                const userProfile=document.getElementById("userProfile");
                                const profileImage = document.getElementById("profileImage");
                                
                                const profilePictureURL = "https://png.pngtree.com/png-clipart/20191121/original/pngtree-user-icon-png-image_5097430.jpg"; 
                                userProfile.style.display = "flex";</script>';
        } else if(isset($_POST['username']) && isset($_POST['pw']) && isset($_POST['email'])){
            global $username,$password; 
            $username = $_POST['username'];
            $password = $_POST['pw'];
            $email = $_POST['email'];
            $s = "localhost";
            $u = "DBA";
            $p = "dba";
            $db = "dream keys";

            $user = [];
            $conn = mysqli_connect($s,$u,$p,$db);
            $query = $conn -> prepare("Select * from users where user_id = ? LIMIT 1;");
            $query -> bind_param('s',$username);
            $query -> execute();
            $result = $query -> get_result();
            while($row = $result -> fetch_assoc()){
                array_push($user,$row);
            };
            $query -> close();
            $conn->close();
            if(!empty($user) && $username == $user[0]['user_id']){
                $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>User Id already exists</p></div>';
            } else {
                $s = "localhost";
                $u = "DBA";
                $p = "dba";
                $db = "dream keys";
                global $username,$password,$email;
                $hashed_pw = password_hash($password,PASSWORD_DEFAULT);
                $conn = mysqli_connect($s,$u,$p,$db);
                $query = $conn -> prepare("Insert into users (user_id,hashed_password,email) VALUES (?,?,?)");
                $query -> bind_param('sss',$username,$hashed_pw,$email);
                $query -> execute();
                $query -> close();
                $conn->close();
                $_SESSION['status'] = '<div class="message"><i class="ph ph-check-circle"></i><p>User Registered successfully</p></div>';
            }
            }    
        else if(isset($_POST['username']) && isset($_POST['pw']) && !isset($_POST['email'])){
        
        global $username,$password; 
        $username = $_POST['username']; 
        $password = $_POST['pw'];
        $s = "localhost";
        $u = "DBA";
        $p = "dba";
        $db = "dream keys";

        $user = [];
        $conn = mysqli_connect($s,$u,$p,$db);
        $query = $conn -> prepare("Select * from users where user_id = ?");
        $query -> bind_param('s',$username);
        $query -> execute();
        $result = $query -> get_result();
        while($row = $result -> fetch_assoc()){
            array_push($user,$row);
        };
        $query -> close();
        $conn->close();

        if(!empty($user) && password_verify($password,$user[0]['hashed_password'])){
            $_SESSION['username'] = $user[0]['user_id'];
            $_SESSION['password'] = $user[0]['hashed_password'];
                $_SESSION['status'] = '<div class="message"><i class="ph-fill ph-check-circle"></i><p> You have successfully logged in</p></div>';
                header('Location: '.'index.php');
        } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
            header('Location: '.'index.php');
            
            
}
}
?>
        </nav>
        
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
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        
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
        }

        
        if (email === "") {
            emailError.textContent = "Please enter your email.";
            isValid = false;
        } else if (!emailPattern.test(email)) {
            emailError.textContent = "Please enter a valid email address.";
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

