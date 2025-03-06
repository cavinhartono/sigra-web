<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Files</title>
</head>

<body>
  <?php
  if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
      echo "<p style='color: green;'>File berhasil diunggah!</p>";
    } elseif ($_GET['status'] == 'error') {
      echo "<p style='color: red;'>Gagal mengunggah file!</p>";
    }
  }
  ?>
  <form method="POST" enctype="multipart/form-data">
    <div class="input_fill">
      <label for="file">Masukan File</label>
      <input type="file" name="fileToUpload" id="file">
    </div>
    <button type="submit" name="submit">Upload</button>
  </form>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // if (isset($_POST["submit"])) {
    //   $targetDir = "upload/";
    //   $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    //   $uploadOk = 1;
    //   $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    //   if (!is_dir($targetDir)) {
    //     mkdir($targetDir, 0777, true);
    //   }

    //   if (file_exists($targetFile)) {
    //     echo "Maaf, file sudah ada.";
    //     $uploadOk = 0;
    //   }

    //   $allowedTypes = ["jpg", "jpeg", "png", "gif", "pdf", "docx"];
    //   if (!in_array($fileType, $allowedTypes)) {
    //     echo "Maaf, hanya file JPG, JPEG, PNG, GIF, PDF, dan DOCX yang diperbolehkan.";
    //     $uploadOk = 0;
    //   }

    //   if ($_FILES["fileToUpload"]["size"] > 2 * 1024 * 1024) {
    //     echo "Maaf, ukuran file terlalu besar (maksimal 2MB).";
    //     $uploadOk = 0;
    //   }

    //   if ($uploadOk == 1) {
    //     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
    //       header("Location: upload_file.php?status=success");
    //     } else {
    //       header("Location: upload_file.php?status=error");
    //     }
    //   } else {
    //     header("Location: upload_file.php?status=error");
    //   }
    // }
  }

  ?>
</body>

</html>