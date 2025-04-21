<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = $_POST["job_title"];
    $description = $_POST["description"];
    $payment_method = $_POST["payment_method"];

    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $cv_file = $_FILES["cv_file"]["name"];
    $target_file = $target_dir . basename($cv_file);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($file_type != "pdf") {
        $error = "Only PDF files are allowed.";
    } elseif (move_uploaded_file($_FILES["cv_file"]["tmp_name"], $target_file)) {
        // Connect to database
        $conn = new mysqli("localhost", "root", "", "job_portalweb");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO user_cvs (job_title, cv_file, description, payment_method) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $job_title, $cv_file, $description, $payment_method);

        if ($stmt->execute()) {
            $success = "CV posted successfully!";
        } else {
            $error = "Database error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $error = "Failed to upload file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Post Your CV</title>
  <style>
    body {
      font-family: Arial;
      background: #f0f0f0;
      padding: 30px;
    }
    .form-container {
      max-width: 450px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
    }
    h2 {
      text-align: center;
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input, select, textarea, button {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
    }
    button {
      background-color: #28a745;
      color: white;
      border: none;
      margin-top: 20px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
    .message {
      text-align: center;
      padding: 10px;
      margin-bottom: 15px;
    }
    .success {
      color: green;
    }
    .error {
      color: red;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Post Your CV</h2>

  <?php if (!empty($success)): ?>
    <div class="message success"><?= $success ?></div>
  <?php elseif (!empty($error)): ?>
    <div class="message error"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <label for="job_title">Job Title:</label>
    <input type="text" name="job_title" id="job_title" required>

    <label for="cv_file">Upload CV (PDF only):</label>
    <input type="file" name="cv_file" id="cv_file" accept=".pdf" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="4"></textarea>

    <label for="payment_method">Payment Method:</label>
    <select name="payment_method" id="payment_method" required>
      <option value="">--Select--</option>
      <option value="bkash">Bkash</option>
      <option value="rocket">Rocket</option>
      <option value="nagad">Nagad</option>
      <option value="upay">Upay</option>
    </select>

    <button type="submit">Submit CV</button>
  </form>
</div>

</body>
</html>
