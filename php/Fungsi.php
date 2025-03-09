<?php
require_once "config.php";

function hitungGajiPokok($tahunMasuk, $golongan)
{
  $lama_kerja = date('Y') - $tahunMasuk;
  if ($lama_kerja >= 5) {
    return ($golongan == "A") ? 3000000 : 2500000;
  }

  return ($lama_kerja < 5 and $golongan == "B") ? 2000000 : 1500000;
}

function mengambilNamaBulan($angka)
{
  switch ($angka) {
    case 1:
      return "Bulan 1: Januari";
    case 2:
      return "Bulan 2: Februari";
    case 3:
      return "Bulan 3: Maret";
    case 4:
      return "Bulan 4: April";
    case 5:
      return "Bulan 5: Mei";
    case 6:
      return "Bulan 6: Juni";
    case 7:
      return "Bulan 7: Juli";
    case 8:
      return "Bulan 8: Agustus";
    case 9:
      return "Bulan 9: September";
    case 10:
      return "Bulan 10: Oktober";
    case 11:
      return "Bulan 11: November";
    case 12:
      return "Bulan 12: Desember";
    default:
      return "Nama bulan tersebut tidak tersedia.";
  }
}

function deretanGanjil()
{
  $Results = [];
  $i = 1;
  while ($i <= 17) {
    $Results[] = $i;
    $i += 2;
  }

  return $Results;
}

function deretanEksponensial()
{
  $Results = [];
  for ($j = 2; $j <= 64; $j *= 2) {
    $Results[] = $j;
  }

  return $Results;
}

function deretanPolaNegatifPositif($count)
{
  $Results = [];
  $n = -2;
  $i = 0;
  while ($i++ < $count) {
    $Results[] = $n;
    $n *= -2;
  }

  return $Results;
}

function deretanFibonacci($count)
{
  $a = 1;
  $b = 1;
  $Results = [$a];
  for ($i = 1; $i < $count; $i++) {
    $Results[] = $b;
    $b += $a;
    $a = $b - $a;
  }

  return $Results;
}
