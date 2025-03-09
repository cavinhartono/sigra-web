<?php
session_start();

define('UPLOAD_DIR', 'uploads/');

if (!is_dir(UPLOAD_DIR)) {
  mkdir(UPLOAD_DIR, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
  $file = $_FILES['file'];
  $filename = basename($file['name']);
  $filesize = $file['size'];
  $filetype = $file['type'];
  $filetmp = $file['tmp_name'];
  $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

  $allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];
  $max_size = 2 * 1024 * 1024; // Ukuran: 2MB

  if (!in_array($filetype, $allowed_types)) {
    $_SESSION['error'] = 'Hanya file gambar (JPG, JPEG, dan PNG) dan PDF yang diperbolehkan!';
  } elseif ($filesize > $max_size) {
    $_SESSION['error'] = 'Ukuran file tidak boleh lebih dari 2MB!';
  } else {
    $destination = UPLOAD_DIR . time() . "_" . $filename;
    if (move_uploaded_file($filetmp, $destination)) {
      $_SESSION['success'] = 'File berhasil diunggah!';
    } else {
      $_SESSION['error'] = 'Gagal mengunggah file!';
    }
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

$uploaded_files = array_diff(scandir(UPLOAD_DIR), ['.', '..']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload File Gambar ataupun PDF</title>
  <style>
    .result {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: grid;
      place-content: center;
      transition: 0.3s;
      background: rgba(34, 34, 34, 0.75);
      backdrop-filter: blur(32px);
      display: none;
    }

    img {
      height: 600px;
    }
  </style>
</head>

<body>
  <h2>Upload File (Gambar/PDF, max 2MB)</h2>
  <?php
  if (isset($_SESSION['error'])) {
    echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
  }
  if (isset($_SESSION['success'])) {
    echo "<p style='color:green;'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
  }
  ?>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
  </form>
  <h3>File yang sudah diunggah:</h3>
  <table>
    <thead>
      <tr>
        <th>Nama File</th>
        <th>Tipe</th>
        <th>Ukuran</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($uploaded_files as $file): ?>
        <tr>
          <td><?= htmlspecialchars($file) ?></td>
          <td><?= strtoupper(pathinfo($file, PATHINFO_EXTENSION)) ?></td>
          <td align="right"><?= round(filesize(UPLOAD_DIR . $file) / 1024, 2) ?> KB</td>
          <td>
            <?php if (preg_match('/\.(jpg|jpeg|png)$/i', $file)): ?>
              <button onclick="openImage('uploads/<?= htmlspecialchars($file) ?>')">View</button>
            <?php else: ?>
              <a href="uploads/<?= htmlspecialchars($file) ?>" target="_blank"> Download </a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div id="result" class="result">
    <div class="detail">
      <img id="image" src="">
      <button id="close-modal" onclick="closeImage()">&times;</button>
    </div>
  </div>
  <script>
    const result = document.querySelector('#result');
    const image = document.querySelector('#image');

    function openImage(src) {
      result.style.display = "flex";
      image.src = src;
    }

    function closeImage() {
      result.style.display = "none";
      image.src = '';
    }

    result.addEventListener('click', (event) => {
      if (e.target === result) {
        closeImage();
      }
    })
  </script>
</body>

</html>