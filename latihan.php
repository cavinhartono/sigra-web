<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/latihan.css">
  <style>
    @import url("./css/master.css");

    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      display: grid;
      place-content: center;
      background: #f6f6f6;
      color: #222;
    }

    select,
    input {
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    button:hover {
      background: darkseagreen;
    }

    button {
      border: none;
      outline: none;
      background: lightgreen;
      width: 100%;
      padding: 8px 24px;
      border-radius: 4px;
      transition: 0.3s;
      cursor: pointer;
      text-transform: uppercase;
    }

    label {
      opacity: 0.75;
    }

    details {
      margin-top: 16px;
    }

    details div {
      border-left: 2px solid #000;
      border-right: 2px solid #000;
      border-bottom: 2px solid #000;
      padding: 1em;
    }

    details div>*+* {
      margin-top: 1em;
    }

    details+details {
      margin-top: .5rem;
    }

    summary {
      list-style: none;
    }

    summary::-webkit-details-marker {
      display: none;
    }

    summary {
      border: 2px solid #000;
      padding: .75em 1em;
      cursor: pointer;
      position: relative;
      padding-left: calc(1.75rem + .75rem + .75rem);
    }

    summary:before {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: .75rem;
      content: "↓";
      width: 1.75rem;
      height: 1.75rem;
      background-color: #000;
      color: #FFF;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      flex-shrink: 0;
    }

    details[open] summary {
      background-color: #eee;
    }

    details[open] summary:before {
      content: "↑";
    }

    summary:hover {
      background-color: #eee;
    }

    .input_fill {
      display: none;
    }

    .field.option {
      flex-direction: row;
    }

    .select_fill {
      position: relative;
      padding: 16px 0;
    }

    .select_fill::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 100%;
      height: 2px;
      background: #222;
      border-radius: 24px;
    }

    .choice option:disabled {
      background: #e7e7e7;
    }

    .container {
      position: relative;
      width: 100%;
    }

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
    }

    .detail {
      background: #fff;
      box-shadow: 0px 8px 45px rgba(34, 34, 34, 0.1);
      padding: 48px 24px;
      border-radius: 8px;
    }

    .detail .text {
      margin: 16px 0 24px;
      font-size: 1.5rem;
    }

    .form {
      background: #fff;
      box-shadow: 0px 8px 45px rgba(34, 34, 34, 0.1);
      padding: 24px;
      border-end-start-radius: 8px;
      border-end-end-radius: 8px;
    }

    .field {
      margin: 16px 0;
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
  </style>
  <title>Latihan</title>
</head>

<body>
  <div class="container">
    <form method="POST" class="form">
      <div class="select_fill">
        <label for="mathematical-formula">Pilih Rumus:</label>
        <select class="choice" name="mathematicalFormula" id="mathematical-formula">
          <option value="" selected> -- Pilih salah satu</option>
          <option value="" disabled> Pertemuan 3</option>
          <option value="segitiga">Luas Segitiga</option>
          <option value="pythagores">Pythagores</option>
          <option value="lingkaran">Keliling Lingkaran</option>
        </select>
      </div>
      <div id="input-fill" class="input_fill">
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
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
      $formula = $_POST['mathematicalFormula'];
      $x = isset($_POST['x']) ? floatval($_POST['x']) : 0;
      $y = isset($_POST['y']) ? floatval($_POST['y']) : 0;

      switch ($formula) {
        case "segitiga":
          $formulaTitle = "Hasil untuk Luas Segitiga";
          $result = 0.5 * $x * $y;
          break;
        case "pythagores":
          $formulaTitle = "Hasil untuk Pythagores";
          $result = sqrt(pow($x, 2) + pow($y, 2));
          break;
        case "lingkaran":
          $formulaTitle = "Hasil untuk Kel. Lingkaran";
          $result = 2 * M_PI * $x;
          break;
        default:
          $formulaTitle = "Hasil untuk Rumus";
          $result = null;
          break;
      }
    }
  }
  ?>
  <?php if (isset($result)): ?>
    <div id="result-formula" class="result">
      <div class="detail">
        <h1 class="title"><?php echo $formulaTitle ?></h1>
        <details>
          <summary class="title">Langkah Pengerjaan</summary>
          <?php switch ($formula):
            case "segitiga": ?>
              <div>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>L</mi>
                    <mo>=</mo>
                    <mfrac>
                      <mn>1</mn>
                      <mn>2</mn>
                    </mfrac>
                    <mo>&#x22C5;</mo>
                    <mi>a</mi>
                    <mo>&#x22C5;</mo>
                    <mi>t</mi>
                  </math>
                </p>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>L</mi>
                    <mo>=</mo>
                    <mfrac>
                      <mn>1</mn>
                      <mn>2</mn>
                    </mfrac>
                    <mo>&#x22C5;</mo>
                    <mi><?php echo $x ?></mi>
                    <mo>&#x22C5;</mo>
                    <mi><?php echo $y ?></mi>
                  </math>
                </p>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>L</mi>
                    <mo>=</mo>
                    <mfrac>
                      <mn>1</mn>
                      <mn>2</mn>
                    </mfrac>
                    <mo>&#x22C5;</mo>
                    <mi><?php echo ($x * $y) ?></mi>
                  </math>
                </p>
              </div>
              <?php break ?>
            <?php
            case "pythagores": ?>
              <div>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>c</mi>
                    <mo>=</mo>
                    <msqrt>
                      <mrow>
                        <msup>
                          <mi>a</mi>
                          <mn>2</mn>
                        </msup>
                        <mo>+</mo>
                        <msup>
                          <mi>b</mi>
                          <mn>2</mn>
                        </msup>
                      </mrow>
                    </msqrt>
                  </math>
                </p>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>c</mi>
                    <mo>=</mo>
                    <msqrt>
                      <mrow>
                        <msup>
                          <mi><?php echo pow($x, 2) ?></mi>
                        </msup>
                        <mo>+</mo>
                        <msup>
                          <mi><?php echo pow($y, 2) ?></mi>
                        </msup>
                      </mrow>
                    </msqrt>
                  </math>
                </p>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>c</mi>
                    <mo>=</mo>
                    <msqrt>
                      <mrow>
                        <msup>
                          <mi><?php echo pow($x, 2) + pow($y, 2) ?></mi>
                        </msup>
                      </mrow>
                    </msqrt>
                  </math>
                </p>
              </div>
              <?php break ?>
            <?php
            case "lingkaran": ?>
              <div>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>K</mi>
                    <mo>=</mo>
                    <mn>2</mn>
                    <mo>&#x22C5;</mo>
                    <mi>&#x03C0;</mi> <!-- Simbol pi -->
                    <mo>&#x22C5;</mo>
                    <mi>r</mi>
                  </math>
                </p>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>K</mi>
                    <mo>=</mo>
                    <mn>2</mn>
                    <mo>&#x22C5;</mo>
                    <mi>&#x03C0;</mi> <!-- Simbol pi -->
                    <mo>&#x22C5;</mo>
                    <mi><?php echo $x ?></mi>
                  </math>
                </p>
                <p class="text">
                  <math xmlns="http://www.w3.org/1998/Math/MathML">
                    <mi>K</mi>
                    <mo>=</mo>
                    <mi><?php echo (2 * $x) ?></mi>
                    <mo>&#x22C5;</mo>
                    <mi>&#x03C0;</mi> <!-- Simbol pi -->
                  </math>
                </p>
              </div>
              <?php break ?>
          <?php endswitch ?>
        </details>
        <h4 class="text"><?php echo (($result == floor($result) ? floor($result) : number_format((float) $result, 2, '.', ''))) ?> cm<sup>2</sup></h4>
        <button id="close-modal" class="btn">Tutup</button>
      </div>
    </div>
  <?php endif ?>
  <script>
    document.querySelector("#mathematical-formula").onchange = () => {
      let mathematicalFormula = document.querySelector("#mathematical-formula").value;
      let inputFields = document.querySelector("#input-fill");
      let labelX = document.querySelector("#labelX");
      let labelY = document.querySelector("#labelY");

      function labelFills(title, display) {
        Object.entries(title).forEach(([id, value], index) => {
          const label = document.getElementById(id);
          if (label) {
            label.innerHTML = `${value}<sup style='color: #f00'>*</sup>`;
            label.style.display = display[index] || "inline-block";
          }
        });
      }

      function inputYFill(display, required) {
        document.querySelector("#b").style.display = display;
        document.querySelector("#b").required = required;
      }

      switch (mathematicalFormula) {
        case "segitiga":
          labelFills({
            labelX: "Masukan Alas",
            labelY: "Masukan Tinggi"
          }, ['inline-block', 'inline-block']);
          inputYFill("block", true)
          inputFields.style.display = "block";
          break;
        case "pythagores":
          labelFills({
            labelX: "Masukan A",
            labelY: "Masukan B"
          }, ['inline-block', 'inline-block']);
          inputYFill("block", true)
          inputFields.style.display = "block";
          break;
        case "lingkaran":
          inputYFill("none", false)
          labelFills({
            labelX: "Masukan Jari-jari",
            labelY: ""
          }, ['inline-block', 'none']);
          inputFields.style.display = "block";
          break;
        default:
          inputFields.style.display = "none";
          break;
      }
    }

    document.querySelector("#close-modal").onclick = () => {
      // document.querySelector('#result-formula').classList.remove("active");
      document.querySelector('#result-formula').style.display = "none";
    }

    window.onclick = (event) => {
      let result = document.querySelector('#result-formula');
      if (event.target === modal) {
        // result.classList.remove("active");
        document.querySelector('#result-formula').style.display = "none";
      }
    }
  </script>
</body>

</html>