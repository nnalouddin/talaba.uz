<?php
require 'db.php';

$sql = "SELECT * FROM students ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    exit("Talabalarni olishda xatolik yuz berdi.");
}
?>

<!doctype html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bosh sahifa — Student's CRUD</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css">
</head>

<body>
    <nav class="navbar navbar-dark">
        <div class="container py-2 d-flex flex-wrap gap-3">
            <a class="navbar-brand me-auto" href="index.html">
                <img src="img/logo_tersu.png">
                Student's CRUD</a>
        </div>
    </nav>
    <main class="container page-wrap">
        <a href="add.php" class="btn btn-primary">
            <i class="fa-solid fa-plus me-2"></i>Add
        </a>
        <div class="card p-3 mt-3">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>TR</th>
                            <th>Familiyasi</th>
                            <th>Ismi</th>
                            <th>Sharifi</th>
                            <th>Data</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    $tr = 1;

    while ($student = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?= $tr++ ?></td>
            <td><?= $student['lname'] ?></td>
            <td><?= $student['fname'] ?></td>
            <td><?= $student['patronymic'] ?></td>
            <td><?= date('d.m.Y', strtotime($student['birthdate'])) ?></td>

            <td class="actions">
                <a href="update.php?id=<?= (int)$student['id'] ?>"
                   class="btn btn-success">
                    <i class="fa-solid fa-arrows-rotate me-2"></i>Update
                </a>

                <!-- <a href="update.php?id=<?php echo (int)$student['id']; ?>"
   class="btn btn-success">
    <i class="fa-solid fa-arrows-rotate me-2"></i>Update
</a> -->

                <a href="delete.php?id=<?= (int)$student['id'] ?>"
                   class="btn btn-danger">
                    <i class="fa-solid fa-trash me-2"></i>Delete
                </a>

<!-- <a href="delete.php?id=<?php echo (int)$student['id']; ?>"
   class="btn btn-danger">
    <i class="fa-solid fa-trash me-2"></i>Delete
</a> -->

            </td>
        </tr>
    <?php } ?>

    <?php if (mysqli_num_rows($result) === 0) { ?>
        <tr>
            <td colspan="6" class="text-center">
                Hozircha talabalar mavjud emas.
            </td>
        </tr>
    <?php } ?>
</tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>