<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $db->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $statement->bindParam(":email", $email, PDO::PARAM_STR);
    $statement->execute();

    $auth = $statement->fetch(PDO::FETCH_ASSOC);

    if ($auth && password_verify($password, $auth['password'])) {
      $_SESSION['auth'] = $auth['id'];
      $_SESSION['name'] = explode(" ", $auth['name'])[0];
      $_SESSION['counter'] = 0;
      header("Location: ../halaman/home.php");
    } else {
      $_SESSION['counter']++;
      if ($_SESSION['counter'] > 3) {
        $_SESSION['counter'] = 0;
        echo "<script>
        alert('Anda sudah melebihi 3 dan halaman ini akan otomatis close');
        window.close();
        </script>";
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    :root {
      --black-primary: #222;
      --black-secondary: rgba(34, 34, 34, 0.75);
      --white-primary: #f5f5f5;
      --white-secondary: #fff;
      --dark-blue-400: #83a2ff;
      --dark-blue-500: #5b77f9;
      --dark-blue-600: #3d4fee;
      --bxShadow-primary: 0 8px 45px rgba(34, 34, 34, 0.1);
    }

    body {
      height: 100vh;
      display: grid;
      place-content: center;
      background: var(--dark-blue-400);
      transition: 0.3s;
    }

    body.active {
      background: var(--dark-blue-500) !important;
    }

    .headline {
      font-size: 1.8rem;
    }

    .title {
      font-size: 1.5rem;
    }

    :is(.title, .headline) {
      color: var(--black-primary);
    }

    :is(input, button, select) {
      border: none;
      outline: none;
      font-size: 1em;
      font-weight: 500;
      border-radius: 8px;
    }

    :is(input, select) {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
    }

    button {
      background: transparent;
      padding: 12px 24px;
      color: var(--white-secondary);
      box-shadow: var(--bxShadow-primary);
      transition: 0.3s;
    }

    .btn-primary {
      background: var(--dark-blue-500);
    }

    .btn-primary:hover {
      background: var(--dark-blue-600);
    }

    .selection {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
    }

    .selection label {
      width: 100%;
      border: 1px solid #ddd;
      padding: 8px;
      background: var(--white-secondary);
      box-shadow: var(--bxShadow-primary);
      border-radius: 4px;
      text-align: center;
      transition: 0.1s;
      cursor: pointer;
    }

    .selection input[type="radio"] {
      visibility: hidden;
      position: absolute;
    }

    .selection input:checked+label {
      border: none;
      background: var(--dark-blue-600) !important;
      color: var(--white-secondary);
    }

    .container {
      position: relative;
      width: 800px;
      height: 500px;
    }

    .blur {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 500px;
      background: rgba(255, 255, 255, 0.5);
      box-shadow: var(--bxShadow-primary);
      border-radius: 8px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .box {
      position: relative;
      width: 50%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 16px;
    }

    .auth {
      position: absolute;
      top: 0;
      left: 0;
      width: 50%;
      height: 100%;
      border-radius: 8px;
      background: var(--white-secondary);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      transition: 0.5s ease-in-out;
      z-index: 5;
    }

    .auth.active {
      left: 50%;
    }

    .container-form {
      position: absolute;
      left: 0;
      width: 100%;
      padding: 50px;
      background: var(--white-secondary);
      transition: 0.5s;
    }

    .auth.active .container-form:nth-child(2) {
      left: 0;
    }

    .auth.active .container-form:nth-child(1) {
      left: -100%;
    }

    .container-form:nth-child(2) {
      left: 100%;
    }

    .form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .gender {
      opacity: 0.75;
      font-size: 1rem;
      font-weight: 600;
    }
  </style>
</head>

<body>
  <section class="container">
    <div class="blur">
      <!-- Go to Login -->
      <div class="box">
        <h1 class="headline">Sudah punya akun?</h1>
        <button class="btn-primary" id="isRegister">Masuk</button>
      </div>
      <!-- Go to Register -->
      <div class="box">
        <h1 class="headline">Tidak punya akun?</h1>
        <button class="btn-primary" id="isRegister">Buat</button>
      </div>
    </div>
    <div class="auth">
      <!-- Login Page -->
      <div class="container-form">
        <form method="POST" class="form">
          <h1 class="title">Masuk Akun</h1>
          <input type="text" name="email" placeholder="Email">
          <input type="password" name="password" placeholder="Password">
          <button type="submit" class="btn-primary" name="submit">Lanjut</button>
        </form>
      </div>
      <!-- Register Page -->
      <div class="container-form">
        <form action="./homepage.php" method="POST" class="form">
          <h1 class="title">Buat Akun</h1>
          <input type="text" name="username" placeholder="Username">
          <input type="text" name="name" placeholder="Nama Lengkap">
          <select name="location">
            <option>Lokasi</option>
            <option value="Bandung">Bandung</option>
            <option value="Jakarta">Jakarta</option>
            <option value="Surabaya">Surabaya</option>
            <option value="Bali">Bali</option>
          </select>
          <div class="selection">
            <input type="radio" name="gender" id="male" value="man">
            <label for="male">
              Pria
            </label>
            <input type="radio" name="gender" id="female" value="woman">
            <label for="female">
              Wanita
            </label>
          </div>
          <input type="password" name="password" placeholder="Password">
          <button type="submit" class="btn-primary" name="submit">Lanjut</button>
        </form>
      </div>
    </div>
  </section>
  <script>
    document.querySelectorAll("#isRegister").forEach((item) => {
      item.addEventListener("click", () => {
        document.querySelector("body").classList.toggle("active");
        document.querySelector(".auth").classList.toggle("active");
      });
    })
  </script>
</body>

</html>