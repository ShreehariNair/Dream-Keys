<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.png">
    <title>Dreamkeys</title>
      <link rel="stylesheet" href="homestyle.css">  
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
    $message = '';

    if(isset($_SESSION['status'])){
        echo $_SESSION['status'];
        $_SESSION['status'] = '';
    }
    if(isset($_POST['signout']) && $_POST['signout'] == 'true'){
        session_reset();
        session_destroy();
        echo '<script>window.location.href("home.php")</script>';
    }
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        
      echo '<form method="POST" action="home.php"><div class="h-btn">
      <a href="profile.html"><div id="userProfile" class="user-circle"><i class="ph-fill ph-user-circle"></i></div></a>
      <input type="hidden" name="signout" value="true"><button onclick="showMessage()"id="logoutButton" class="h-btn1">Logout</button></div></form>';

    } else {
    echo '<div class="h-btn user">
    <button onclick="show()" id="loginButton" class="h-btn1">Login</button>
    <button onclick="showregister()" id="signUpButton" class="h-btn2">Sign Up</button>
    </div>
    
    <div id="overlay" style="display: none;">
            <div class="credentials">
            <div class="login" style="display: none;">
            <form class="form" method="POST" action="home.php">
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
            <form class="form" method="POST" action="home.php">
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
            $s = "mysql-6362f39-student-86e0.c.aivencloud.com";
            $u = "avnadmin";
            $p = "AVNS_ch4yIylQ2kinVTCYSxk";
            $db = "defaultdb";
            $port = 11316;

            $user = [];
            $conn = mysqli_connect($s,$u,$p,$db,$port);
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
                $s = "mysql-6362f39-student-86e0.c.aivencloud.com";
$u = "avnadmin";
$p = "AVNS_ch4yIylQ2kinVTCYSxk";
$db = "defaultdb";
$port = 11316;
                global $username,$password,$email;
                $hashed_pw = password_hash($password,PASSWORD_DEFAULT);
                $conn = mysqli_connect($s,$u,$p,$db,$port);
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
        $s = "mysql-6362f39-student-86e0.c.aivencloud.com";
$u = "avnadmin";
$p = "AVNS_ch4yIylQ2kinVTCYSxk";
$db = "defaultdb";
$port = 11316;

        $user = [];
        $conn = mysqli_connect($s,$u,$p,$db,$port);
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
                echo '<script>window.location.href("home.php")</script>';
            } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
            echo '<script>window.location.href("home.php")</script>';
            
            
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
        echo '<script>window.location.href("home.php")</script>';
    }
    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        
      echo '<form method="POST" action="home.php"><div class="mobile-h-btn">
      <a href="profile.html"><div id="userProfile" class="user-circle"><i class="ph-fill ph-user-circle" style="color:#121b25"></i></div></a>
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
            <form class="form" method="POST" action="home.php">
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
            <form class="form" method="POST" action="home.php">
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
            $s = "mysql-6362f39-student-86e0.c.aivencloud.com";
$u = "avnadmin";
$p = "AVNS_ch4yIylQ2kinVTCYSxk";
$db = "defaultdb";
$port = 11316;

            $user = [];
            $conn = mysqli_connect($s,$u,$p,$db,$port);
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
                $s = "mysql-6362f39-student-86e0.c.aivencloud.com";
$u = "avnadmin";
$p = "AVNS_ch4yIylQ2kinVTCYSxk";
$db = "defaultdb";
$port = 11316;
                global $username,$password,$email;
                $hashed_pw = password_hash($password,PASSWORD_DEFAULT);
                $conn = mysqli_connect($s,$u,$p,$db,$port);
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
        $s = "mysql-6362f39-student-86e0.c.aivencloud.com";
$u = "avnadmin";
$p = "AVNS_ch4yIylQ2kinVTCYSxk";
$db = "defaultdb";
$port = 11316;

        $user = [];
        $conn = mysqli_connect($s,$u,$p,$db,$port);
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
                echo '<script>window.location.href("home.php")</script>';
            } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
            echo '<script>window.location.href("home.php")</script>';

        }
}
?>
        </nav>
    </header>
    <section class="home">
        <div class="home-text">
            <h1>Find your dream home with ease and confidence.</h1>
            <p>Discover your perfect property with us! 
               We offer a wide range of buying, selling, and rental options, all backed by expert guidance. 
               Let us help you make your real estate journey seamless and stress-free.</p>
               <div class="hsearch">
                    <form>
                        <input type="search" placeholder="Search By Location.." class="search-input">
                        <input type="submit" value="Search">
                    </form>
               </div>
        </div>
        <div class="home-img">
            <video src="Video2.mp4" id="myvideo" width="900" height="900" autoplay loop>Your browser does not support the video tag</video>
        </div>
    </section>
  <section class="feature">
  <div class="centre-left">
    <h2>Feature In</h2>
  </div>
  <div class="feature-content">
    <div class="f-img">
        <img src="img1/img/f1.png" alt="content1">
    </div>
    <div class="f-img">
        <img src="img1/img/f2.png" alt=content2>
    </div><div class="f-img">
        <img src="img1/img/f3.png" alt="content3">
    </div><div class="f-img">
        <img src="img1/img/f4.png" alt="content4">
    </div><div class="f-img">
        <img src="img1/img/f5.png" alt="content5">
    </div>
  </div>
  </section>
  <section class="property">
    <div class="centre-left">
        <h2>Popular Residence</h2>
    </div>
    <div class="property-content">
        <div class="row">
            <img src="img1/img/p1.png" alt="residance1">
            <h5>Aaradhya Emerald Enclave</h5>
            <p>Sector 19,Palm Beach Road,Nerul,Navi Mumbai,Maharashtra</p>
            <div class="list">
                <a href="#" class="residance-list">
                <i class='bx bx-bed'></i>
                3 Bed
            </a>
            <a href="#" class="residance-list">
                <i class='bx bx-bath' ></i>
                2 Bath
            </a>
            <a href="#" class="residance-list">
                <i class='bx bx-shape-square'></i>
                1900 sqft
            </a>
            </div>
        </div>
        <div class="row">
            <img src="img1/img/p2.png" alt="residance2">
            <h5>Celestia Opulent</h5>
            <p>Plot No 22,MG Road,Sector 9,Kharghar,Navi Mumbai,Maharashtra</p>
            <div class="list">
                <a href="#" class="residance-list">
                <i class='bx bx-bed'></i>
                4 Bed
            </a>
            <a href="#" class="residance-list">
                <i class='bx bx-bath' ></i>
                3 Bath
            </a>
            <a href="#" class="residance-list">
                <i class='bx bx-shape-square'></i>
                2200 sqft
            </a>
            </div>
        </div>
        <div class="row">
            <img src="img1/img/p3.png" alt="residance3">
            <h5>Hiranandani Garden</h5>
            <p>Plot No 5,Railway Station Road,Sector 8,Airoli,Navi Mumbai,Maharashtra</p>
            <div class="list">
                <a href="#" class="residance-list">
                <i class='bx bx-bed'></i>
                2 Bed
            </a>
            <a href="#" class="residance-list">
                <i class='bx bx-bath' ></i>
                2 Bath
            </a>
            <a href="#" class="residance-list">
                <i class='bx bx-shape-square'></i>
                1500 sqft
            </a>
            </div>
        </div>
    </div>
    <div class="centre-btn">
        <a href="index.php" class="btn">View All Properties</a>
    </div>
  </section>
  <section class="about">
    <div class="about-img">
        <img src="about-image.jpg" alt="about-image">
    </div>
    <div class="about-text">
        <h2>We help people to find and rent Homes</h2>
        <p>At DreamKeys, we’re passionate about connecting people with their dream properties.
           With years of experience in the real estate market, we specialize in buying, selling, and renting homes that suit every lifestyle and budget. 
           Our dedicated team provides personalized service, guiding you through every step of the process with transparency and care. 
           Whether you’re a first-time buyer, a seasoned investor, or looking for your next rental, we’re here to make your real estate journey seamless and successful. 
           Trust us to help you find a place to call home!</p>
        <div class="icons">
            <a href="#"><i class='bx bxl-facebook' ></i></a>
            <a href="#"><i class='bx bxl-instagram' ></i></a>
            <a href="#"><i class='bx bxl-twitter' ></i></a>
        </div>
           <a href="#" class="btn">Get In Touch</a>
    </div>
  </section>
  <section id="contact">
    <div class="contact-content">
     <img src="logonew.jpg" alt="logo">
     <p> Contact us today for personalized real estate assistance to turn your property dreams into reality.</p>
        </div>
        <div class="contact-content">
        <h4>Projects</h4>
        <ul>
        <li><a href="#">Houses</a></li>
        <li><a href="#">Rooms</a></li>
        <li><a href="#">Flats</a></li>
        </ul>
    </div>
    <div class="contact-content">
        <h4>Company</h4>
        <ul>
        <li><a href="#">How we work?</a></li>
        <li><a href="#">Features</a></li>
        <li><a href="#">News and Blogs</a></li>
        </ul>
        </div>
        <div class="contact-content">
        <h4>Support</h4>
        <ul>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Support Center</a></li>
        <li><a href="#">Contact Us</a></li>
        </ul>
        </div>
        <div class="contact-content">
        <h4>Follow Us on</h4>
        <div class="icons">
            <a href="#"><i class='bx bxl-facebook' ></i></a>
            <a href="#"><i class='bx bxl-instagram' ></i></a>
            <a href="#"><i class='bx bxl-twitter' ></i></a>
        </div>
        </div>
  </section>
  <footer class="footer-privacy">
    <span class="footer-copy">
        &#169; DreamKeys. All rights reserved 
    </span>
  </footer>
  <script src="auth.js"></script>  
  <script src="home.js"></script>
  <script src="menu.js"></script>

</body>
</html>