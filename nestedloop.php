<?php

$tinggi = $_POST['tinggi'] ?? 5;
$arah = $_POST['arah'] ?? 'atas';
$hasil = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $angka = filter_var($tinggi, FILTER_VALIDATE_INT);

    if ($angka === false || $angka < 1 || $angka > 20) {
        $hasil = 'Masukkan angka antara 1 sampai 20.';
    } elseif (!in_array($arah, ['atas', 'kanan', 'bawah', 'kiri'], true)) {
        $hasil = 'Arah tidak valid.';
    } else {

        // Ukuran area pola
        $ukuran = 2 * $angka - 1;

        for ($baris = 0; $baris < $ukuran; $baris++) {
            for ($kolom = 0; $kolom < $ukuran; $kolom++) {

                // Koordinat relatif dari pusat
                $x = $kolom - ($angka - 1);
                $y = $baris - ($angka - 1);

                // Rotasi pola
                switch ($arah) {
                    case 'atas':
                        $u = $x;
                        $v = -$y;
                        break;

                    case 'kanan':
                        $u = $y;
                        $v = $x;
                        break;

                    case 'bawah':
                        $u = -$x;
                        $v = $y;
                        break;

                    case 'kiri':
                        $u = -$y;
                        $v = -$x;
                        break;
                }

                // Membentuk segitiga sama kaki
                if ($v >= 0 && $v < $angka && abs($u) <= $v) {
                    $hasil .= '*';
                } else {
                    $hasil .= ' ';
                }
            }

            $hasil .= "\n";
        }
    }
}

?>

<form method="POST">

    <label>Tinggi segitiga:</label>
    <input type="number" name="tinggi" min="1" max="20" value="<?= htmlspecialchars((string) $tinggi) ?>" required>

    <br><br>

    <label>Arah pucuk:</label>
    <select name="arah">
        <option value="atas" <?= $arah === 'atas' ? 'selected' : '' ?>>Atas (12)</option>
        <option value="kanan" <?= $arah === 'kanan' ? 'selected' : '' ?>>Kanan (3)</option>
        <option value="bawah" <?= $arah === 'bawah' ? 'selected' : '' ?>>Bawah (6)</option>
        <option value="kiri" <?= $arah === 'kiri' ? 'selected' : '' ?>>Kiri (9)</option>
    </select>

    <button type="submit">Generate</button>

</form>

<pre><?= htmlspecialchars($hasil) ?></pre>