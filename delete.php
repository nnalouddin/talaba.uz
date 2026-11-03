<?php
require 'db.php';

// URL orqali talabaning ID raqamini olamiz
$id = (int)($_GET['id'] ?? 0);

// Tanlangan talabani topamiz
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$student) {
    exit("Talaba topilmadi.");
}

// O‘chirish tugmasi bosilganda ishlaydi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    // O‘chirilgandan keyin bosh sahifaga qaytamiz
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talabani o‘chirish — Student's CRUD</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-dark">
        <div class="container py-2 d-flex flex-wrap gap-3">
            <a class="navbar-brand me-auto" href="index.php">
                <img src="img/logo_tersu.png" alt="TerDU logotipi">
                Student's CRUD
            </a>
        </div>
    </nav>

    <main class="container page-wrap">
        <h2 class="mb-3">Talabani o‘chirish</h2>

        <div class="card p-4 text-center">
            <div class="mb-3">
                <i class="fa-solid fa-trash text-danger fs-1"></i>
            </div>

            <h4>Ushbu talabani o‘chirmoqchimisiz?</h4>

            <div class="table-responsive my-3">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Familiyasi</th>
                            <th>Ismi</th>
                            <th>Sharifi</th>
                            <th>Tug‘ilgan sanasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo (int)$student['id']; ?></td>
                            <td><?php echo $student['lname']; ?></td>
                            <td><?php echo $student['fname']; ?></td>
                            <td><?php echo $student['patronymic']; ?></td>
                            <td>
                                <?php
                                echo date(
                                    'd.m.Y',
                                    strtotime($student['birthdate'])
                                );
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <form action="delete.php?id=<?php echo $id; ?>" method="post">
                <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash me-2"></i>O‘chirish
                    </button>

                    <a href="index.php" class="btn btn-secondary">
                        <i class="fa-solid fa-xmark me-2"></i>Bekor qilish
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>