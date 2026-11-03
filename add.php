<?php
require 'db.php';

$error = "";

// Saqlash tugmasi bosilganda ishlaydi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lname = trim($_POST['lname'] ?? '');
    $fname = trim($_POST['fname'] ?? '');
    $patronymic = trim($_POST['patronymic'] ?? '');
    $birthdate = $_POST['birthdate'] ?? '';

    if ($lname === '' || $fname === '' ||
        $patronymic === '' || $birthdate === '') {

        $error = "Barcha maydonlarni to‘ldiring.";

    } else {

        // Yangi talabani qo‘shish
        $sql = "INSERT INTO students
                (lname, fname, patronymic, birthdate)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        // Formadan kelgan qiymatlarni so‘rovga bog‘laymiz
        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $lname,
            $fname,
            $patronymic,
            $birthdate
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Saqlangandan keyin bosh sahifaga qaytamiz
        header("Location: index.php");
        exit;
    }
}
?>

<!doctype html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talaba qo‘shish — Student's CRUD</title>

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
        <h2 class="mb-3">Talaba qo‘shish</h2>

        <div class="card p-4">

            <?php if ($error !== "") { ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form action="add.php" method="post">

                <div class="mb-3">
                    <label for="lname" class="form-label">
                        Familiyasi
                    </label>
                    <input type="text"
                           class="form-control"
                           id="lname"
                           name="lname"
                           maxlength="100"
                           placeholder="Familiyasini kiriting"
                           required>
                </div>

                <div class="mb-3">
                    <label for="fname" class="form-label">
                        Ismi
                    </label>
                    <input type="text"
                           class="form-control"
                           id="fname"
                           name="fname"
                           maxlength="100"
                           placeholder="Ismini kiriting"
                           required>
                </div>

                <div class="mb-3">
                    <label for="patronymic" class="form-label">
                        Sharifi
                    </label>
                    <input type="text"
                           class="form-control"
                           id="patronymic"
                           name="patronymic"
                           maxlength="100"
                           placeholder="Otasining ismini kiriting"
                           required>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">
                        Tug‘ilgan sanasi
                    </label>
                    <input type="date"
                           class="form-control"
                           id="birthdate"
                           name="birthdate"
                           required>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Saqlash
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