<?php
session_start();

if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

if (isset($_GET['reset'])) {
    unset($_SESSION['contacts']);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-center">📒 Daftar Kontak</h1>
        <div class="flex justify-between mb-4">
            <a href="add.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tambah Kontak</a>
            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</a>
        </div>
        <?php if (empty($_SESSION['contacts'])): ?>
            <p class="text-gray-500 text-center">Belum ada kontak tersimpan.</p>
        <?php else: ?>
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Nomor HP</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['contacts'] as $index => $contact): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2"><?= htmlspecialchars($contact['nama']); ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($contact['email']); ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($contact['telepon']); ?></td>
                            <td class="border px-4 py-2 text-center">
                                <a href="edit.php?id=<?= $index; ?>" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <a href="delete.php?id=<?= $index; ?>" class="text-red-600 hover:underline" onclick="return confirm('Hapus kontak ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
