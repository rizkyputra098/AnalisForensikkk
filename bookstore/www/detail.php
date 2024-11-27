<?php require_once 'inc/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Detail</title>
  <?php require_once 'inc/header.php'; ?>

  <style>
    /* Set background image for the whole page */
    body {
      background: url('https://blog.danasyariah.id/wp-content/uploads/2023/08/131-0-Unsplash.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: Arial, sans-serif;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.8); /* Adding slight transparency to make text readable */
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 80%;
      max-width: 1200px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .col-md-4, .col-md-8 {
      padding: 10px;
    }

    .col-md-4 img {
      width: 100%;
      border-radius: 8px;
    }

    .col-md-8 h3 {
      color: #333;
      margin-bottom: 10px;
    }

    .col-md-8 p {
      color: #555;
      font-size: 16px;
    }

    .btn {
      display: block;
      width: 200px;
      margin: 20px auto;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2>Produk Detail</h2>
  <div class="row">
    <div class="col-md-4">
      <?php
        $sql = "SELECT * FROM books WHERE id = {$_GET['id']} LIMIT 1";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . $conn->error;
        } else {
            $row = $result->fetch_assoc();

            if ($row) {
                if (strpos($row["image"], "http://") !== false) {
                    echo '<img src="'. $row["image"] .'" alt="'. $row["title"] .'" class="img-fluid">';
                } else {
                    echo '<img src="img/'. $row["image"] .'" alt="'. $row["title"] .'" class="img-fluid">';
                }
            } else {
                echo "Produk not found.";
            }
        }

      ?>
    </div>
    <div class="col-md-8">
      <?php
        if ($result === false) {
            echo "Error: " . $conn->error;
        } else {
            if ($row) {
                echo "<h3>Produk: " . $row["title"] . "</h3>";
                echo "<p><strong>Merek:</strong> " . $row["author"] . "</p>";
                echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";
                echo "<p><strong>ID:</strong> " . $row["id"] . "</p>";
            } else {
                echo "Produk not found.";
            }

            $result->free();
        }

        $conn->close();

      ?>
    </div>
  </div>
  <a href="index.php" class="btn btn-primary">Back to Home</a>
</div>

<!-- <div class="container mt-4">
   
</div> -->



</body>
</html>
