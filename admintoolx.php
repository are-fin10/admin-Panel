<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folderName = 'up';
    if (!is_dir($folderName)) {
        mkdir($folderName, 0777, true);
    }

    
    $titleFiles = glob("$folderName/[0-9]*.txt");
    $nextTitleNumber = count($titleFiles) + 1;
    $titleFileName = "$folderName/$nextTitleNumber.txt";

    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    file_put_contents($titleFileName, $title);

    
    $detailsFiles = glob("$folderName/[a-z].txt");
    $nextDetailsLetter = chr(97 + count($detailsFiles));
    if ($nextDetailsLetter <= 'z') {
        $detailsFileName = "$folderName/$nextDetailsLetter.txt";

        $details = htmlspecialchars($_POST['details'], ENT_QUOTES, 'UTF-8');
        file_put_contents($detailsFileName, $details);
    } else {
        echo "<p>All detail file slots (a-z) are used!</p>";
        exit();
    }

    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageFiles = glob("$folderName/[0-9]*.jpg");
        $nextImageNumber = count($imageFiles) + 1; 
        $imageFileName = "$folderName/$nextImageNumber.jpg";

        move_uploaded_file($_FILES['image']['tmp_name'], $imageFileName);
    }

    echo "<p style='text-align:center; color:green;'>Data saved successfully! <a href=''>Go back</a></p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
        }
        .container {
            max-width: 600px;
            margin: 60px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 28px;
            color: #2a5298;
            margin-bottom: 20px;
            font-weight: 600;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 14px;
            color: #444;
        }
        input, textarea, button {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #1e3c72;
            box-shadow: 0 0 10px rgba(30, 60, 114, 0.3);
        }
        button {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: linear-gradient(135deg, #2a5298, #1e3c72);
            box-shadow: 0 8px 20px rgba(42, 82, 152, 0.3);
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #aaa;
        }
        .footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter title" required>

            <label for="image">Choose Image</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <label for="details">Details</label>
            <textarea id="details" name="details" rows="5" placeholder="Enter details" required></textarea>

            <button type="submit">Save</button>
        </form>
    </div>
    <div class="footer">
        &copy; 2024 <a href="#">TOOL-X</a>. All rights reserved.
    </div>
</body>
</html>