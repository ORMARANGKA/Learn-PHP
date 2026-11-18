<?php
$tinggi = $_POST['tinggi'] ?? '';
$error = '';
$hasil = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $angka = filter_var($tinggi, FILTER_VALIDATE_INT);

    if ($angka === false || $angka < 1 || $angka > 20) {
        $error = 'Masukkan angka antara 1 dan 20.';
    } else {
        for ($baris = 1; $baris <= $angka; $baris++) {
            for ($spasi = 1; $spasi <= $angka - $baris; $spasi++) {
                $hasil .= ' ';
            }

            for ($bintang = 1; $bintang <= 2 * $baris - 1; $bintang++) {
                $hasil .= '*';
            }

            $hasil .= "\n";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Segitiga Bintang</title>
</head>

<body>
    <h1>Segitiga Bintang</h1>

    <form method="post">
        <label for="tinggi">Tinggi segitiga (1–20):</label>
        <input type="number" id="tinggi" name="tinggi" min="1" max="20" required
            value="<?= htmlspecialchars((string) $tinggi, ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit">Tampilkan</button>
    </form>

    <?php if ($error !== ''): ?>
        <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <?php if ($hasil !== ''): ?>
        <pre><?= htmlspecialchars($hasil, ENT_QUOTES, 'UTF-8') ?></pre>
    <?php endif; ?>
</body>

</html>