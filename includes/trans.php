<?php
session_start();

// Optional: Handle language switch via GET (if you want to store preference)
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Language Switcher</title>
    <style>
        /* Button style */
        .lang-btn {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            margin: 0 5px;
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
