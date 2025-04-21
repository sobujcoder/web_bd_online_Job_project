<div id="header">
  <div class="container">
    <div class="header-left">
      <div class="logo-container">
        <img src="../assets/images/logo.png" alt="logo">
        <h3>BD online job protocol</h3>
      </div>
      <nav class="navbar">
        <ul>
          <li><a href="../index.php">Home</a> </li>
          <li><a href="../findJobs.php">Find Jobs</a></li>
          <li><a href="../browseCompanies.php">Browse Companies</a></li>
          <li><a href="cv.php">Post CV</a></li>

          
          <!-- <li><a href="">About Us</a></li> -->
          <!-- <li><a href="">Contact Us</a></li> -->
        </ul>
      </nav>
    </div>

    <div class="navigation header-right">
      <?php
      session_start();
      // Check if the user is logged in
      if (isset($_SESSION['email'])) {
        // User is logged in, display the user's name and dropdown menu
        $username = explode('@', $_SESSION['email'])[0];
        echo '<div class="dropdown">';
        echo '<button class="dropdown-btn">' . 'Hi,  ' . $username . '!' . '</button>';
        echo '<div class="dropdown-content">';
        echo '<a href="../dashboard/dashboard.php" class="nav-link"> <i class="fa-solid fa-table-cells-large"></i> Dashboard</a>';
        echo '<a href="../dashboard/editProfile.php" class="nav-link"> <i class="fa-solid fa-user"></i> My Profile</a>';
        echo '<a href="../process/logout.php" class="nav-link"> <i class="fa-solid fa-power-off"></i> Logout</a>';
        echo '</div>';
        echo '</div>';
      } else {
        // User is not logged in, display the "Sign In" button
        echo '<a href="../login.php" class="btn">Sign In</a>';
      }
      ?>
      
<html>
<head>
    <meta charset="UTF-8">
    <title>Language Switcher</title>
    <style>
        /* Button style */
        .lang-btn {
            padding: 10px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            margin: 0 0px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- NAVIGATION BAR -->
    <nav>
        <!-- Language buttons -->
        <button class="lang-btn" onclick="translateTo('en')">English</button>
        <button class="lang-btn" onclick="translateTo('bn')">বাংলা</button>
    </nav>

    <!-- Hidden Google Translate Element -->
    <div id="google_translate_element" style="display: none;"></div>

    <!-- Google Translate JS -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script>
        function translateTo(lang) {
            const select = document.querySelector("select.goog-te-combo");
            if (!select) return;
            select.value = lang;
            select.dispatchEvent(new Event("change"));
        }
    </script>
</body>
</html>

    </div>
  </div>
</div>
<!DOCTYPE html>