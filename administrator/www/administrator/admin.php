<?php
session_start();
require_once 'inc/config.php';

if (!$_SESSION['admin']) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST["title"];
    $author = $_POST["author"];
    $description = $_POST["description"];

    $targetDirectory = "uploads/";
    $imageName = basename($_FILES["image"]["name"]);
    $imageExtension = end(explode('.', $imageName));
    $targetFile = $targetDirectory . md5(time() . rand() . $imageName) . '.' . $imageExtension;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imageLink = 'http://' . $_SERVER['HTTP_HOST'] . '/administrator/' . $targetFile;

        $sql = "INSERT INTO bookstore.books (title, author, image, description) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $author, $imageLink, $description);

        if ($stmt->execute()) {
            echo "<script>alert('Book inserted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error ."');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Produk</title>
    <!-- Importing Google Fonts and FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Reset and general styles */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        /* Set background image for the whole page */
        body {
            background: url('https://blog.danasyariah.id/wp-content/uploads/2023/08/131-0-Unsplash.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Form container styling */
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 80%;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .file-input-container {
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border: 2px dashed #6990F2;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .file-input-container i {
            font-size: 40px;
            color: #6990F2;
        }

        .file-input-container p {
            color: #6990F2;
            font-size: 16px;
            margin-top: 10px;
        }

        .form-control, .form-control-file {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #6990F2;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #5a7cc3;
        }

        /* Progress bar styling */
        .progress-area {
            margin-top: 20px;
            padding: 10px;
        }

        .uploaded-area {
            max-height: 232px;
            overflow-y: scroll;
        }

        .uploaded-area .row {
            margin-bottom: 10px;
            background: #E9F0FF;
            list-style: none;
            padding: 15px 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
    </style>
</head>
<body>

<div class="container mt-4">
    <h2>Admin - Masukan Produk</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Title Input -->
        <div class="form-group">
            <label for="title">Nama Produk:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <!-- Author Input -->
        <div class="form-group">
            <label for="author">Merek:</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>

        <!-- Description Input -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <!-- File Upload Section -->
        <div class="file-input-container">
            <input class="file-input" type="file" name="image" id="image" accept="image/*" hidden>
            <i class="fas fa-cloud-upload-alt"></i>
            <p>Browse File to Upload</p>
        </div>

        <!-- Submit Button -->
        <button type="submit">Simpan Produk</button>
    </form>

    <!-- Progress and Uploaded File Area -->
    <section class="progress-area"></section>
    <section class="uploaded-area"></section>
</div>

<script>
    // File upload functionality
    const form = document.querySelector("form"),
    fileInput = document.querySelector(".file-input"),
    progressArea = document.querySelector(".progress-area"),
    uploadedArea = document.querySelector(".uploaded-area");

    // Trigger file input click on form click
    form.querySelector(".file-input-container").addEventListener("click", () => {
        fileInput.click();
    });

    // Handle file selection
    fileInput.onchange = ({target}) => {
        let file = target.files[0];
        if (file) {
            let fileName = file.name;
            if (fileName.length >= 12) {
                let splitName = fileName.split('.');
                fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
            }
            uploadFile(fileName);
        }
    }

    function uploadFile(name) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/upload.php");
        xhr.upload.addEventListener("progress", ({loaded, total}) => {
            let fileLoaded = Math.floor((loaded / total) * 100);
            let progressHTML = `
            <li class="row">
                <i class="fas fa-file-alt"></i>
                <div class="content">
                    <div class="details">
                        <span class="name">${name} • Uploading</span>
                        <span class="percent">${fileLoaded}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" style="width: ${fileLoaded}%"></div>
                    </div>
                </div>
            </li>`;
            uploadedArea.classList.add("onprogress");
            progressArea.innerHTML = progressHTML;
            if (loaded === total) {
                progressArea.innerHTML = "";
                let uploadedHTML = `
                <li class="row">
                    <div class="content upload">
                        <i class="fas fa-file-alt"></i>
                        <div class="details">
                            <span class="name">${name} • Uploaded</span>
                        </div>
                    </div>
                    <i class="fas fa-check"></i>
                </li>`;
                uploadedArea.classList.remove("onprogress");
                uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);
            }
        });
        let data = new FormData(form);
        xhr.send(data);
    }
</script>

<!-- Add Bootstrap JS and Popper.js scripts here -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
