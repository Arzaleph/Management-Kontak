<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $telepon = trim($_POST['telepon']);
    $errors = [];

    if (empty($nama)) $errors[] = "Nama harus diisi.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tidak valid.";
    if (empty($telepon) || !preg_match("/^[0-9]+$/", $telepon)) $errors[] = "Nomor telepon hanya boleh angka.";

    if (empty($errors)) {
        $_SESSION['contacts'][] = ['nama' => $nama, 'email' => $email, 'telepon' => $telepon];
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-6">
        <h1 class="text-xl font-bold mb-4 text-center">Tambah Kontak</h1>
        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    <?php foreach ($errors as $error) echo "<li>$error</li>"; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="POST" class="space-y-4">
            <div>
                <label class="block font-semibold mb-1">Nama:</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-semibold mb-1">Nomor Telepon:</label>
                <input type="text" name="telepon" value="<?= htmlspecialchars($_POST['telepon'] ?? '') ?>" class="w-full border p-2 rounded">
            </div>
            <div class="flex justify-between mt-4">
                <a href="index.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
