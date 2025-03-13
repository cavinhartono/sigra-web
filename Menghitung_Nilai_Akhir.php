<?php
session_start();

$hasil = [];

if (isset($_POST['submit'])) {
  $nims = $_POST['nim'];
  $namas = $_POST['nama'];
  $absensis = $_POST['absensi'];
  $tugass = $_POST['tugas'];
  $kuiss = $_POST['kuis'];
  $utss = $_POST['uts'];
  $uass = $_POST['uas'];

  $jumlah = count($nims);

  for ($i = 0; $i < $jumlah; $i++) {
    $nilai_absensi = $absensis[$i] * 0.10;
    $nilai_tugas_kuis = (($tugass[$i] + $kuiss[$i]) / 2) * 0.20;
    $nilai_uts = $utss[$i] * 0.30;
    $nilai_uas = $uass[$i] * 0.40;

    $nilai_akhir = $nilai_absensi + $nilai_tugas_kuis + $nilai_uts + $nilai_uas;

    if ($nilai_akhir >= 90) {
      $grade = "A";
      $info = "Memuaskan";
    } elseif ($nilai_akhir >= 70) {
      $grade = "B";
      $info = "Baik";
    } elseif ($nilai_akhir >= 60) {
      $grade = "C";
      $info = "Cukup";
    } elseif ($nilai_akhir >= 55) {
      $grade = "D";
      $info = "Kurang";
    } else {
      $grade = "E";
      $info = "Tidak Lulus";
    }

    $hasil[] = [
      'nim' => $nims[$i],
      'nama' => $namas[$i],
      'absensi' => $absensis[$i],
      'tugas' => $tugass[$i],
      'kuis' => $kuiss[$i],
      'uts' => $utss[$i],
      'uas' => $uass[$i],
      'nilai_akhir' => number_format($nilai_akhir, 2),
      'grade' => $grade,
      'info' => $info
    ];
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Nilai Akhir - UAS Pemgembangan Aplikasi berbasis Website</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", Arial, sans-serif;
    }

    body {
      background: #e7e7e7;
      padding: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th:nth-child(2),
    th:nth-child(3),
    td:nth-child(3),
    td:nth-child(2) {
      text-align: left;
    }

    th,
    td {
      padding: 10px;
      text-align: center;
    }

    .btn {
      padding: 10px 15px;
      margin-bottom: 15px;
      cursor: pointer;
      background-color: #4CAF50;
      color: white;
      border: none;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border-radius: 8px;
      width: 400px;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
    }

    .form-group {
      margin-bottom: 10px;
    }

    label {
      display: block;
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 8px;
      margin-top: 4px;
      box-sizing: border-box;
    }
  </style>
</head>

<body>

  <div style="height: 100vh;">
    <h2>Input Nilai Akhir Mahasiswa</h2>

    <button class="btn" onclick="openModal()">Tambah</button>

    <form method="post" action="">
      <table id="tableMahasiswa">
        <thead>
          <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Absensi</th>
            <th>Tugas</th>
            <th>Kuis</th>
            <th>UTS</th>
            <th>UAS</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

      <br>
      <button type="submit" name="submit" class="btn">Submit Semua Data</button>
    </form>
  </div>

  <div style="height: 100vh;">
    <?php if (!empty($hasil)): ?>
      <h3>Hasil Nilai Akhir Mahasiswa</h3>
      <table>
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Absensi</th>
          <th>Tugas</th>
          <th>Kuis</th>
          <th>UTS</th>
          <th>UAS</th>
          <th>Nilai Akhir</th>
          <th>Grade</th>
          <th>Keterangan</th>
        </tr>
        <?php foreach ($hasil as $index => $mhs): ?>
          <tr>
            <td><?= $index + 1; ?></td>
            <td><?= htmlspecialchars($mhs['nim']); ?></td>
            <td><?= htmlspecialchars($mhs['nama']); ?></td>
            <td><?= $mhs['absensi']; ?></td>
            <td><?= $mhs['tugas']; ?></td>
            <td><?= $mhs['kuis']; ?></td>
            <td><?= $mhs['uts']; ?></td>
            <td><?= $mhs['uas']; ?></td>
            <td><?= $mhs['nilai_akhir']; ?></td>
            <td><?= $mhs['grade']; ?></td>
            <?php switch ($mhs['info']):
              case 'Tidak Lulus' ?>
              <td style="color: #f00"><?php echo $mhs['info']; ?></td>
              <?php break ?>
            <?php
              default: ?>
              <td style="color: #4CAF50"><?php echo $mhs['info']; ?></td>
              <?php break ?>
          <?php endswitch ?>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
  </div>

  <div id="modalForm" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>

      <h3>Input Mahasiswa</h3>

      <div class="form-group">
        <label for="nim">NIM</label>
        <input type="text" id="nim">
      </div>

      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" id="nama">
      </div>

      <div class="form-group">
        <label for="absensi">Absensi</label>
        <input type="number" id="absensi" min="0" max="100">
      </div>

      <div class="form-group">
        <label for="tugas">Tugas</label>
        <input type="number" id="tugas" min="0" max="100">
      </div>

      <div class="form-group">
        <label for="kuis">Kuis</label>
        <input type="number" id="kuis" min="0" max="100">
      </div>

      <div class="form-group">
        <label for="uts">UTS</label>
        <input type="number" id="uts" min="0" max="100">
      </div>

      <div class="form-group">
        <label for="uas">UAS</label>
        <input type="number" id="uas" min="0" max="100">
      </div>

      <button class="btn" onclick="addMahasiswa()">Simpan</button>

    </div>
  </div>

  <script>
    let modal = document.getElementById("modalForm");
    let table = document.getElementById("tableMahasiswa").getElementsByTagName('tbody')[0];
    let counter = 0;

    function openModal() {
      modal.style.display = "block";
    }

    function closeModal() {
      modal.style.display = "none";

      document.getElementById("nim").value = "";
      document.getElementById("nama").value = "";
      document.getElementById("absensi").value = "";
      document.getElementById("tugas").value = "";
      document.getElementById("kuis").value = "";
      document.getElementById("uts").value = "";
      document.getElementById("uas").value = "";
    }

    function addMahasiswa() {
      counter++;

      const nim = document.getElementById("nim").value;
      const nama = document.getElementById("nama").value;
      const absensi = document.getElementById("absensi").value;
      const tugas = document.getElementById("tugas").value;
      const kuis = document.getElementById("kuis").value;
      const uts = document.getElementById("uts").value;
      const uas = document.getElementById("uas").value;

      if (!nim || !nama || absensi === "" || tugas === "" || kuis === "" || uts === "" || uas === "") {
        alert("Semua field harus diisi!");
        return;
      }

      const row = table.insertRow();
      row.insertCell(0).innerHTML = counter;
      row.insertCell(1).innerHTML = `<input type="hidden" name="nim[]" value="${nim}">${nim}`;
      row.insertCell(2).innerHTML = `<input type="hidden" name="nama[]" value="${nama}">${nama}`;
      row.insertCell(3).innerHTML = `<input type="hidden" name="absensi[]" value="${absensi}">${absensi}`;
      row.insertCell(4).innerHTML = `<input type="hidden" name="tugas[]" value="${tugas}">${tugas}`;
      row.insertCell(5).innerHTML = `<input type="hidden" name="kuis[]" value="${kuis}">${kuis}`;
      row.insertCell(6).innerHTML = `<input type="hidden" name="uts[]" value="${uts}">${uts}`;
      row.insertCell(7).innerHTML = `<input type="hidden" name="uas[]" value="${uas}">${uas}`;

      closeModal();
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        closeModal();
      }
    }
  </script>

</body>

</html>