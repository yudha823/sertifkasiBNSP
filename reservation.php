<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }
        .harga-kamar,
        .harga-sarapan,
        .sarapan {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .harga-kamar label,
        .harga-sarapan label,
        .sarapan label {
            flex: 1;
        }
        .harga-kamar span,
        .harga-sarapan span,
        .sarapan span {
            flex: 2;
            text-align: right;
        }
        .total-bayar {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 16px;
            text-align: center;
        }
        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
    <script>
        // Fungsi untuk memperbarui harga kamar saat tipe kamar berubah
        function updateHargaKamar() {
            var tipeKamarSelect = document.getElementById("tipeKamar");
            var hargaKamarSpan = document.getElementById("hargaKamar");
            var selectedTipeKamar = tipeKamarSelect.options[tipeKamarSelect.selectedIndex].value;
            // Gantilah dengan harga sesuai dengan tipe kamar Anda
            var hargaKamar = {
                'Kamar Standar': 100,
                'Kamar Deluxe': 150,
                'Kamar Suite': 200
            };
            hargaKamarSpan.textContent = 'Rp ' + (hargaKamar[selectedTipeKamar] * 1000).toLocaleString();

            // Memperbarui total bayar saat tipe kamar berubah
            updateTotalBayar();
        }

        // Fungsi untuk memperbarui total bayar
        function updateTotalBayar() {
            var durasiMenginap = document.getElementById("durasiMenginap").value;
            var hargaKamar = document.getElementById("hargaKamar").textContent;
            hargaKamar = parseInt(hargaKamar.replace(/[^\d]/g, '')); // Menghapus karakter non-angka
            var sarapanCheckbox = document.getElementById("sarapan");
            var biayaSarapan = sarapanCheckbox.checked ? 50 * 1000 * durasiMenginap : 0;

            var totalBayar = (hargaKamar * durasiMenginap) + biayaSarapan;

            // Tambahkan diskon 10% jika durasi menginap lebih dari 3 hari
            if (durasiMenginap > 3) {
                var diskon = 0.1 * totalBayar;
                totalBayar -= diskon;
            }

            // Menampilkan total bayar pada elemen dengan id "totalBayar"
            document.getElementById("totalBayar").textContent = 'Total Bayar: Rp ' + totalBayar.toLocaleString();

            // Menampilkan harga sarapan pada elemen dengan id "hargaSarapan"
            document.getElementById("hargaSarapan").textContent = 'Rp ' + biayaSarapan.toLocaleString();

        }
    </script>
</head>
<body>
    <h1>Form Pemesanan Hotel</h1>

<?php
$hargaKamar = array(
    'Kamar Standar' => 100,
    'Kamar Deluxe' => 150,
    'Kamar Suite' => 200
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $jenisKelamin = $_POST["jenisKelamin"];
    $nomorIdentitas = $_POST["nomorIdentitas"];
    $tipeKamar = $_POST["tipeKamar"];
    $tanggalCheckIn = $_POST["tanggalCheckIn"];
    $durasiMenginap = $_POST["durasiMenginap"];
    $sarapan = isset($_POST["sarapan"]) ? "Ya" : "Tidak";

    // Validasi nomor identitas harus memiliki 16 digit
    if(strlen($nomorIdentitas) !== 16) {
        echo '<p style="color: red;">Nomor Identitas harus terdiri dari 16 digit.</p>';
    } else {
        $totalBayar = $hargaKamar[$tipeKamar] * $durasiMenginap;

        // Biaya tambahan untuk sarapan (gantilah dengan biaya sesuai kebutuhan Anda)
        $biayaSarapan = 50.000 * $durasiMenginap;

        // Tambahkan biaya sarapan jika dipilih
        if ($sarapan == "Ya") {
            $totalBayar += $biayaSarapan;
        }

        // Tambahkan diskon 10% jika durasi menginap lebih dari 3 hari
        if ($durasiMenginap > 3) {
            $diskon = 0.1 * $totalBayar;
            $totalBayar -= $diskon;
            echo '<p><strong>Diskon 10%:</strong> -Rp ' . number_format($diskon, 0, ',', '.') . '</p>';
        }

        echo '<h2>Ringkasan Pemesanan</h2>';
        echo '<p><strong>Nama:</strong> ' . $nama . '</p>';
        echo '<p><strong>Jenis Kelamin:</strong> ' . $jenisKelamin . '</p>';
        echo '<p><strong>Nomor Identitas:</strong> ' . $nomorIdentitas . '</p>';
        echo '<p><strong>Tipe Kamar:</strong> ' . $tipeKamar . '</p>';
        echo '<p><strong>Tanggal Check-in:</strong> ' . $tanggalCheckIn . '</p>';
        echo '<p><strong>Durasi Menginap:</strong> ' . $durasiMenginap . ' hari</p>';
        echo '<p><strong>Sarapan:</strong> ' . $sarapan . '</p>';
        echo '<div class="harga-kamar"><label for="hargaKamar">Harga Kamar:</label><span id="hargaKamar">Rp ' . number_format($hargaKamar[$tipeKamar] * 1000, 0, ',', '.') . '</span></div>';
        echo '<div class="harga-sarapan"><label for="hargaSarapan">Harga Sarapan:</label><span id="hargaSarapan">Rp ' . number_format($biayaSarapan * 1000, 0, ',', '.') . '</span></div>';
        echo '<p id="totalBayar" class="total-bayar"><strong>Total Bayar:</strong> Rp ' . number_format($totalBayar * 1000, 0, ',', '.') . '</p>';
    }
} else {
    $tipeKamarDefault = 'Kamar Standar';
?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" oninput="updateTotalBayar()">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>

        <label for="jenisKelamin">Jenis Kelamin:</label>
        <select name="jenisKelamin" id="jenisKelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label for="nomorIdentitas">Nomor Identitas:</label>
        <input type="text" name="nomorIdentitas" id="nomorIdentitas" required>

        <label for="tipeKamar">Pilih Tipe Kamar:</label>
        <select name="tipeKamar" id="tipeKamar" onchange="updateHargaKamar()" required>
            <option value="Kamar Standar" <?php echo isset($tipeKamarDefault) && $tipeKamarDefault == 'Kamar Standar' ? 'selected' : ''; ?>>Kamar Standar</option>
            <option value="Kamar Deluxe" <?php echo isset($tipeKamarDefault) && $tipeKamarDefault == 'Kamar Deluxe' ? 'selected' : ''; ?>>Kamar Deluxe</option>
            <option value="Kamar Suite" <?php echo isset($tipeKamarDefault) && $tipeKamarDefault == 'Kamar Suite' ? 'selected' : ''; ?>>Kamar Suite</option>
        </select>

        <!-- Menambahkan kolom harga kamar sebagai kolom tersendiri -->
        <div class="harga-kamar">
            <label for="hargaKamar">Harga Kamar:</label>
            <span id="hargaKamar">Rp <?php echo isset($tipeKamarDefault) ? number_format($hargaKamar[$tipeKamarDefault] * 1000, 0, ',', '.') : '0'; ?></span>
        </div>

        <label for="tanggalCheckIn">Tanggal Check-in:</label>
        <input type="date" name="tanggalCheckIn" id="tanggalCheckIn" required>

        <label for="durasiMenginap">Durasi Menginap (dalam hari):</label>
        <input type="number" name="durasiMenginap" id="durasiMenginap" min="1" required>

        <!-- Menambahkan opsi sarapan -->
        <div class="sarapan">
            <label for="sarapan">Tambahkan Sarapan:</label>
            <input type="checkbox" name="sarapan" id="sarapan" value="Ya">
        </div>

        <!-- Menampilkan harga sarapan pada elemen dengan id "hargaSarapan" -->
        <div class="harga-sarapan">
            <label for="hargaSarapan">Harga Sarapan:</label>
            <span id="hargaSarapan">Rp 0</span>
        </div>

        <!-- Menampilkan total bayar pada elemen dengan id "totalBayar" -->
        <p id="totalBayar" class="total-bayar"><strong>Total Bayar:</strong> Rp 0</p>

        <button type="submit">Pesan Sekarang</button>
    </form>
<?php
}
?>
</body>
</html>
