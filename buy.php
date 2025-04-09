<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dream Keys</title>
  <link rel="icon" href="assets/logo.png">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
  crossorigin=""></script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
  href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
  rel="stylesheet">
  <link href="buystyle.css" rel="stylesheet">
  <link href="queries-2.css" rel="stylesheet">

  <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
  <div class="loader-overlay">
      <div class="loader">
</div>
  </div>
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
          <a href="contact.php" class="nav-link">Contact Us</a>
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
        header('Location: '.'buy.php?house='.$h);
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
                header('Location: '.'buy.php?house='.$h);
        } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
            header('Location: '.'buy.php?house='.$h);
            
            
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
    $h = $_GET['house'];
    if(isset($_SESSION['status'])){
        echo $_SESSION['status'];
        $_SESSION['status'] = '';
    }
    if(isset($_POST['signout']) && $_POST['signout'] == 'true'){
        session_reset();
        session_destroy();
        header('Location: '.'buy.php?house='.$h);
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
                header('Location: '.'buy.php?house='.$h);
        } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
}
}
?>
        </nav>
    </header>
  <main>
    <form method="POST" class="property-form">
      <input type="text" placeholder="Search location" class="search-bar">
      <button class="search-btn">
        <i class="ph ph-magnifying-glass icon"></i><p>Search</p>
      </button>
    </form>
    <div class="container">
  
    <div class="property-tab">
    <div class="image-section">
    <img src='#' alt="House image" width="750" height="440" class="view-image">
    <div class="image-preview-box">
    <img src='#' width="70" height="60" alt="house image" class="active-image preview-1">
    <img src='#' width="70" height="60" class="preview-2" alt="house-image">
    <img src='#' width="70" height="60" alt="house image" class="preview-3">
    <img src='#' width="70" height="60" alt="house image" class="preview-4">
    </div>
    </div>
    <div class="property-details">
    <p id="expected-price">Expected price</p>
    <p id="property-price"></p>
    <span class="location">
    <i class="ph ph-map-pin medium-icon"></i><p id="location"></p></span>
    <span class="beds-baths">
    <span class="beds"><i class="ph-fill ph-bed medium-icon"></i><p id="beds-count"></p></span>
    
    <span class="bath">
    <i class="ph ph-bathtub medium-icon"></i><p id='baths-count'></p></span>
  <p id='rooms-count'>rooms</p>
  </span>
  
    <hr>
    <p class="about">About this home</p>
    <div class="house-features">
    <span id="sq-ft-cost"><i class="ph ph-ruler large-icon"></i>&#8377;${Math.ceil(property[0].price / property[0].size)} per sq ft</span>
    <p class="about-line">${property[0].about}</p>
    </div>
    </div>
    <div class="property-location">
    <p class = "about"><i class="ph ph-map-pin"></i>Location
    <div id="map"></div>
    
    </p>
    </div>
    </div>
    <div id="owner-card">
        <p id="title">Owner Details</p>
        <div class="owner-name">
          <p id="owner-name"></p>
        </div>
        <div class="owner-info">
        <div class="owner-phone">
          <i class="ph ph-phone"></i><p id='owner-phone'></p>
        </div>
        <div class="owner-email">
        <i class="ph ph-envelope"></i></i><p id='owner-email'></p>
        </div>
        </div>
</div>
    </div>
  </main>
  <section id="contact">
    <div class="contact-content">
      <img src="assets/logo.png" alt="logo" >
      <p>
        Contact us today for personalized real estate assistance to turn your
        property dreams into reality.
      </p>
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
      <h4>Follow Us</h4>
      <div class="icons">
        <a href="#"><i class="bx bxl-facebook"></i></a>
        <a href="#"><i class="bx bxl-instagram"></i></a>
        <a href="#"><i class="bx bxl-twitter"></i></a>
      </div>
    </div>
  </section>
  <footer class="footer-privacy">
    <span class="footer-copy"> &#169; DreamKeys. All rights reserved </span>
  </footer>
  
  <script src="buyscript.js"></script>
  <script src="menu.js"></script>
  <script src="auth.js"></script>
  <!-- <script src="preview.js"></script> -->

  <style>
    * {
      padding: 0px;
      margin: 0px;
      box-sizing: border-box;
      font-family: "Work Sans", sans-serif;
      list-style:none;
    }
  </style>
</body>

</html>