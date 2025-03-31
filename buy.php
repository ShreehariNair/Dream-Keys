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
  <header>
    <img src="assets/logo.png" width="120" alt="logo" class="logo" height="100">

    <nav class="navbar">
      <div class="link">
        <a href="home.html" class="nav-link">Home</a>
        </div>
        <div class="link">
          <a href="about.html" class="nav-link">About us</a>
        </div>
        <div class="link">
          <a href="index.html" class="nav-link">Buy</a>
        </div>
        <div class="link">
          <a href="rent.html" class="nav-link">Rent</a>
        </div>
        <div class="link">
          <a href="sell.html" class="nav-link">Sell</a>
        </div>
        <div class="link">
          <a href="contact.html" class="nav-link">Contact Us</a>
        </div>
      </nav>
      <!-- <div class="user">
        <button id="login-btn">Login</button>
        <button id="signup-btn">Sign Up</button>
      </div> -->
      <button class="menu-btn">
      </button>
      <nav class="mobile-nav">
        <button class="close-btn"></button>
        <div class="link">
          <i class='bx bx-home nav-icon'></i>
          <a href="home.php" class="nav-link">Home</a>
        </div>
        <div class="link">
          <i class="ph ph-building nav-icon"></i>
          
          <a href="#" class="nav-link">About us</a>
        </div>
        <div class="link">
          <i class="ph ph-money nav-icon"></i>
          <a href="index.php" class="nav-link">Buy</a>
        </div>
        <div class="link">
          <img src="https://img.icons8.com/?size=80&id=qC3UqYpJ9XXn&format=png" width="24" height="21">
          <a href="rent.html" class="nav-link">Rent</a>
        </div>
        <div class="link">
          <i class="ph ph-key nav-icon"></i>
          <a href="sell.php" class="nav-link">Sell</a>
        </div>
        <div class="link">
          <i class="ph ph-phone nav-link"></i>
          
          <a href="#" class="nav-link">Contact Us</a>
        </div>
        <div class="user nav-user">
          <button id="login-btn">Login</button>
          <button id="signup-btn">Sign Up</button>
        </div>
      </nav>
      <?php
    session_start();
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
        
      echo '<form method="POST" action="home.php"><div class="h-btn">
      <div id="userProfile" class="user-circle"><i class="ph-fill ph-user-circle"></i></div></form>
      <input type="hidden" name="signout" value="true"><button id="logoutButton" class="h-btn1">Logout</button>';
    } else {
    echo '<div class="h-btn">
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
                                profileImage.src = profilePictureURL;
                                profileImage.style.display = "block"; 
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
                header('Location: '.'home.php');
        } else {
            $_SESSION['status'] = '<div class="message warning"><i class="ph ph-warning-circle"></i><p>Invalid Password</p></div>';
            header('Location: '.'home.php');
            
            
}
}
?>
  </header>
  <main>
    <form method="POST" class="property-form">
      <input type="text" placeholder="Search location" class="search-bar">
      <button class="search-btn">
        <i class="ph ph-magnifying-glass icon"></i><p>Search</p>
      </button>
    </form>
    <div class="container">
      <!-- <div class="property-tab">
        <div class="image-section">
          <video src="assets/inside-view.mp4" type="video/mp4" autoplay="true" alt="House image" width="750" height="440" class="view-image"></video>
          <div class="image-preview-box">
            <img src="https://t4.ftcdn.net/jpg/03/71/92/67/240_F_371926762_MdmDMtJbXt7DoaDrxFP0dp9Nq1tSFCnR.jpg"
              width="70" height="60" alt="house image" class="preview-1">
            <img src="assets/image.png" width="70" height="60" class="active-image preview-2" alt="house-image">
            <img src="https://t4.ftcdn.net/jpg/10/07/05/19/240_F_1007051990_TsJYcKSjbFRRF2RQmcwAEk0sPDUAyUqE.jpg"
              width="70" height="60" alt="house image" class="preview-3">
            <img src="https://t3.ftcdn.net/jpg/06/39/42/46/240_F_639424665_YGf5eZXs70GJQyKRHYS51uxg4daD8LFL.jpg"
              width="70" height="60" alt="house image" class="preview-4">
          </div>
        </div>
        <div class="property-details">
          <p id="property-price">&#8377;600,000</p>
          <span class="location">
            <i class="ph ph-map-pin medium-icon"></i>Sibsey Road, Boston PE21</span>
          <span class="beds-baths">
            <span class="beds"><i class="ph-fill ph-bed medium-icon"></i>3 beds</span>

            <span class="bath">
              <i class="ph ph-bathtub medium-icon"></i>3 baths</span>
          </span>
          <hr>
          <p class="about">About this home</p>
          <div class="house-features">
            <span id="sq-ft-cost"><i class="ph ph-ruler large-icon"></i>&#8377;500 per sq ft</span>
            <span id="maintainance-fee"><i class="ph ph-currency-circle-dollar large-icon"></i>&#8377;1766 Monthly maintainance fee</span>
          </div>
        </div>
        <div class="property-location">
          <p id = "heading">Location</p>
          <div id="map"></div>
        </div>
      </div> -->
      <!-- <div id="owner-card">
        <p id="title">Owner Details</p>
        <div class="owner-info">
          <img src="assets/owner-img.jpg" alt="Portrait of Peter Parker" class="rounded-img" width="70" height="70">
          <div class="owner-name-job">
            <p id="owner-name">Peter Parker</p>
            <p id="owner-job">Tax Consultant at S&P Global</p>
          </div>
        </div>
        <div class="owner-details">
          <i class='bx bx-lock-alt XL-icon'></i>
          <span class="hidden-message">The user allows only selected users to know their details</span>
        </div>
        <form class="quotation-form">
          <input type="number" class="quotation-input">
          <button class="large-btn">Quote</button>
        </form>
      </div> -->
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
  <!-- <script>
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var map = L.map('map').setView([51.505, -0.09], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var marker = L.marker([51.5, -0.09]).addTo(map);
marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

  </script> -->
  <script src="buyscript.js"></script>
  <script src="menu.js"></script>
  <script src="auth.js"></script>

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