<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dream Keys</title>
    <link href="sellstyle.css" rel="stylesheet" >
    <link href="queries-3.css" rel="stylesheet" >

    <link rel="icon" href="assets/logo.png">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
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
    if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
      $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Please log in to sell property</p></div>';
       echo '<script>location.href="home.php"</script>';
       exit();
    }
    if(isset($_POST['signout']) && $_POST['signout'] == 'true'){
        session_reset();
        session_destroy();
        session_start();
        $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Please log in to sell property</p></div>';
       echo '<script>location.href="home.php"</script>';
        header('Location: '.'home.php');
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
                header('Location: '.'sell.php');
        } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
            header('Location: '.'home.php');
            
            
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
        header('Location: '.'home.php');
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
                header('Location: '.'home.php');
        } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
            header('Location: '.'home.php');  
}
}
?>
        </nav>
    </header>

    <main>
      <div class="sell">
        <div class="container-1 ">
        <h3 class="section-title">Tell us a little about yourself</h3>
        <form method="POST" class="form-1">
          <div class="input-container" id="first-name-container">
          <label>First Name</label>
          <input type="text" class="input-box" id="first-name" required>
          </div>  
          <div class="input-container" id="last-name-container">
          <label>Last Name</label>
          <input type="text" class="input-box" id="last-name" required>
        </div>  
        <div class="input-container" id="email-container">
          <label>Email</label>
          <input type="text" class="input-box" id="email" required>
        </div>  
        <div class="input-container" id="phone-container">
          <label>Phone</label>
          <input type="number" class="input-box" id="phone" required>
        </div>  
  <button id="form-1-btn">Next</button>    
  </form>
        </div>
        <div class="container-2 hidden">
          <h3 class="section-title">Let's verify some home facts</h3>
          <form class="form-2">
          <div class="input-container" id="house-container">
            <label>House</label>
            <select name="type" class="input-box" id="house">
              <option value="Cottage">Cottage</option>
              <option value="Row House">Row House</option>
              <option value="Town House">Town House</option>
              <option value="Villa">Villa</option>
              <option value="Apartment">Apartment</option>
              <option value="Loft">Loft</option>
            </select>
          </div>
          <div class="input-container" id="sqft-container">
          <label>Carpet Area</label>
          <input type="number" class="input-box" id="sqft" required>
          </div>  
          <div class="input-container" id="built-container">
            <label>Year Built</label>
            <input type="number" class="input-box" id="built-year" required>
            </div>  
          <div class="input-container" id="baths-container">
          <label>Bathrooms</label>
          <input type="number" class="input-box" id="baths" required>
        </div>  
        <div class="input-container" id="beds-container">
          <label>Bedrooms</label>
          <input type="number" class="input-box" id="bedrooms" required>
        </div>  
        <div class="input-container" id="price-container">
          <label>Estimated Price</label>
          <input type="number" class="input-box" id="price" required>
        </div>  
          <button id="form-2-btn">Next</button>
        </form>
        </div>
        <div class="container-3 hidden">
          <h3 class="section-title">Let's verify some home facts</h3>
          <form class="form-3">
            <div class="title-container">
            <span class="gallery-icon">
              <i class="ph ph-images "></i>
            </span>
            <div class="dual-titles">
            <p class="bold-title">Upload property image</p>
            <p class="sub-title">Upload a 1600 x 480px image for best results</p>
          </div>
          </div>
          <div class="upload-container">
              <div class="input-container" id="image-container">
                <label>Paste your image url here</label>
                <input type="text" class="input-box" id="image-url">
              </div>
          </div>
          <div class="images-preview">
            
          </div>
          <div class="btn-group">
          <button class="upload-btn">Upload</button>
          <button id="form-3-btn">Next</button>
        </div>
        </form>
        </div>
        <div class="container-4 hidden">
          <h3 class="section-title">Locate your house</h3>
          <form class="form-4">
          <div class="input-container" id="address-container">
          <label>Address</label>
          <input type="text" class="input-box" id="address" required>
          </div>  
          <div class="input-container" id="pincode-container">
            <label>Postal Code</label>
            <input type="number" class="input-box" id="pincode" required>
            </div>  
          <div class="input-container" id="street-container">
          <label>Street</label>
          <input type="text" class="input-box" id="street" required>
        </div>  
        <div class="input-container" id="city-container">
          <label>City</label>
          <input type="text" class="input-box" id="city" required>
        </div> 
        <div class="input-container" id="state-container">
          <label>State</label>
          <input type="text" class="input-box" id="state" required>
        </div>  
        <div class="input-container" id="about-container">
          <label>About your home</label>
          <input type="text" class="input-box" id="about" required>
        </div> 
        <div class="input-container" id="lat-container">
          <label>Latitude</label>
          <input type="text" class="input-box" id="lat" required>
        </div> 
        <div class="input-container" id="long-container">
          <label>Longitude</label>
          <input type="text" class="input-box" id="long" required>
        </div> 
          <button id="form-4-btn">Submit</button>
        </form>
      </div>
      </div>
      
      </main>
      <footer class="footer-privacy">
        <span class="footer-copy">
          &copy;DreamKeys. All rights reserved 
        </span>
      </footer>
      <style>
        * {
          padding: 0px;
          margin: 0px;
          box-sizing: border-box;
        font-family: "Work Sans", sans-serif;
        list-style:none;
      }
      </style>
      <script src="sell.js"></script>
      <script src="menu.js"></script>

  </body>
</html>
