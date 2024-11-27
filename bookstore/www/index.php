<?php require_once 'inc/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library</title>
  <?php require_once 'inc/header.php'; ?>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Lora|Merriweather:300,400" rel="stylesheet">
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    table th, table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    table th {
      background-color: #f4f4f4;
      color: #333;
    }

    table tr:hover {
      background-color: #f1f1f1;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2>List of Produk</h2>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Merek</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT id, title, author FROM books";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // Output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['id']}</td>
                      <td>{$row['title']}</td>
                      <td>{$row['author']}</td>
                      <td><a href=\"detail.php?id={$row['id']}\">View Details</a></td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='4'>No Produk found</td></tr>";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
</div>

<!-- <footer>
  <div class="container">
       <div class="row">

            <div class="col-md-5 col-md-offset-1 col-sm-6">
                 <h3>Kelompok 6 Studio</h3>
                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                 <div class="footer-copyright">
                      <p>Copyright &copy; 2024</p>
                 </div>
            </div>

            <div class="col-md-4 col-md-offset-1 col-sm-6">
                 <h3>Talk to us</h3>
                 <p><i class="fa fa-globe"></i> Indonesia</p>
                 <p><i class="fa fa-phone"></i> 010-020-0990</p>
                 <p><i class="fa fa-save"></i> info@company.com</p>
            </div>

            <div class="clearfix col-md-12 col-sm-12">
                 <hr>
            </div>

            <div class="col-md-12 col-sm-12">
                 <ul class="social-icon">
                      <li><a href="#" class="fa fa-facebook"></a></li>
                      <li><a href="#" class="fa fa-twitter"></a></li>
                      <li><a href="#" class="fa fa-google-plus"></a></li>
                      <li><a href="#" class="fa fa-dribbble"></a></li>
                      <li><a href="#" class="fa fa-linkedin"></a></li>
                 </ul>
            </div>
            
       </div>
  </div>
</footer> -->


</body>
</html>
