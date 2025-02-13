<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @import url("./css/master.css");

    .input_fill {
      display: none;
    }
  </style>
  <title>Latihan</title>
</head>

<body>
  <div class="container">
    <form method="POST">
      <div class="select-fill">
        <label for="mathematical-formula">Pilih Rumus:</label>
        <select class="choice" name="mathematicalFormula" id="mathematical-formula">
          <option value="" selected></option>
          <option value="segitiga">Luas Segitiga</option>
          <option value="pythagores">Pythagores</option>
          <option value="lingkaran">Keliling Lingkaran</option>
        </select>
      </div>
      <div id="input-fill" class="input_fill">
        <h1 id="title" class="title"></h1>
        <div class="field">
          <label for="a" id="labelX">Masukan</label>
          <input type="number" id="a" name="x" required>
        </div>
        <div class="field">
          <label for="b" id="labelY">Masukan</label>
          <input type="number" id="b" name="y" required>
        </div>
        <button type="submit" class="btn" name="submit">Hitung</button>
      </div>
    </form>
  </div>
  <?php
  if (isset($_POST['submit'])) {
    $formula = $_POST['mathematicalFormula'];
    $x = isset($_POST['x']) ? floatval($_POST['x']) : 0;
    $y = isset($_POST['y']) ? floatval($_POST['y']) : 0;

    switch ($formula) {
      case "segitiga":
        $result = 0.5 * $x * $y;
        echo "0.5 x $x x $y = $result";
        break;
      case "pythagores":
        $result = sqrt(pow($x, 2) + pow($y, 2));
        echo "$result";
        break;
      case "lingkaran":
        $result = 2 * M_PI * $x;
        echo "$result";
        break;
      default:
        echo "";
        break;
    }
  }
  ?>
  <script>
    document.querySelector("#mathematical-formula").onchange = () => {
      let mathematicalFormula = document.querySelector("#mathematical-formula").value;
      let inputFields = document.querySelector("#input-fill");
      let labelX = document.querySelector("#labelX");
      let labelY = document.querySelector("#labelY");
      let inputY = document.querySelector("#b");
      let title = document.querySelector("#title");

      switch (mathematicalFormula) {
        case "segitiga":
          title.innerText = "Luas Segitiga";
          inputFields.style.display = "block";
          labelX.innerText = "Masukan Alas";
          labelY.innerText = "Masukan Tinggi";
          inputY.style.display = "block";
          labelY.style.display = "inline-flex";
          inputY.required = true;
          break;
        case "pythagores":
          title.innerText = "Pythagores";
          inputFields.style.display = "block";
          labelX.innerText = "Masukan A";
          labelY.innerText = "Masukan B";
          labelY.style.display = "inline-flex";
          inputY.style.display = "block";
          inputY.required = true;
          break;
        case "lingkaran":
          title.innerText = "Keliling Lingkaran";
          labelX.innerText = "Masukan Jari-jari";
          labelY.style.display = "none";
          inputY.required = false;
          inputY.style.display = "none";
          inputFields.style.display = "block";
          break;
        default:
          title.innerText = "";
          inputFields.style.display = "none";
          break;
      }
    }
  </script>
</body>

</html>