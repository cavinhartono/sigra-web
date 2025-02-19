<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan ke-2</title>
</head>

<body>
  <form method="POST">
    <div id="input-fill" class="input_fill">
      <div class="field">
        <label for="nip">NIP</label>
        <input type="text" name="nip" id="nip" required>
      </div>
      <div class="field">
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" required>
      </div>
      <div class="field">
        <label for="lamaKerja">Lama Kerja</label>
        <input type="number" name="lamaKerja" id="lamaKerja" required>
      </div>
      <div class="field">
        <p>Masukan Golongan:</p>
        <input type="radio" name="golongan" id="a" value="a">
        <label for="a">A</label>
        <input type="radio" name="golongan" id="b" value="b">
        <label for="b">B</label>
      </div>
    </div>
    <button type="submit" class="btn" name="submit">Hitung</button>
  </form>

  <?php
  function hitungGajiPokok($tahunMasuk, $golongan)
  {
    $lama_kerja = date('Y') - $tahunMasuk;
    if ($lama_kerja >= 5 && $golongan == "A") {
      return 3000000;
    } elseif ($lama_kerja >= 5 || $golongan == "A") {
      return 2500000;
    } else if ($lama_kerja < 5 && $golongan == "B") {
      return 2000000;
    } else {
      return 1500000;
    }

    // if ($lama_kerja >= 5) {
    //   return ($golongan == "A") ? 3000000 : 2500000;
    // }

    // return ($lama_kerja < 5 and $golongan == "B") ? 2000000 : 1500000;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
      $nip = $_POST['nip'];
      $nama = $_POST['nama'];
      $golongan = isset($_POST['golongan']) ? strtoupper($_POST['golongan']) : '';
      $lamaKerja = isset($_POST['lamaKerja']) ? (int)$_POST['lamaKerja'] : 0;
      $hasil = hitungGajiPokok($lamaKerja, $golongan);
    }
  }

  ?>

  <?php if (isset($hasil)): ?>
    <p><?= $nip ?> | <?= $nama ?> | <?= (date('Y') - $lamaKerja) ?> Tahun (dari <?= $lamaKerja ?>)</p>
    <p>Hasil: Rp <?= number_format($hasil, 2, ',', '.') ?></p>
  <?php endif ?>
</body>

</html>