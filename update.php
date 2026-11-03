<?php
require 'db.php';

$error = "";

// URL orqali talabaning ID raqamini olamiz
$id = (int)($_GET['id'] ?? 0);

// Tanlangan talabani bazadan olamiz
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

// Bunday talaba mavjud bo‘lmasa
if (!$student) {
    exit("Talaba topilmadi.");
}

// Yangilash tugmasi bosilganda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lname = trim($_POST['lname'] ?? '');
    $fname = trim($_POST['fname'] ?? '');
    $patronymic = trim($_POST['patronymic'] ?? '');
    $birthdate = $_POST['birthdate'] ?? '';

    if ($lname === '' || $fname === '' ||
        $patronymic === '' || $birthdate === '') {

        $error = "Barcha maydonlarni to‘ldiring.";

    } else {

        // Tanlangan talaba ma’lumotlarini yangilaymiz
        $sql = "UPDATE students
                SET lname = ?, fname = ?, patronymic = ?, birthdate = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "ssssi",
            $lname,
            $fname,
            $patronymic,
            $birthdate,
            $id
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: index.php");
        exit;
    }

    // Xatolik bo‘lsa, kiritilgan qiymatlarni formaga qaytaramiz
    $student['lname'] = $lname;
    $student['fname'] = $fname;
    $student['patronymic'] = $patronymic;
    $student['birthdate'] = $birthdate;
}
?>

<!doctype html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Talabani yangilash — Student's CRUD</title>

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
        <h2 class="mb-3">Talabani yangilash</h2>

        <div class="card p-4">

            <?php if ($error !== "") { ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form action="update.php?id=<?php echo $id; ?>" method="post">

                <div class="mb-3">
                    <label for="lname" class="form-label">
                        Familiyasi
                    </label>
                    <input type="text"
                           class="form-control"
                           id="lname"
                           name="lname"
                           maxlength="100"
                           value="<?php echo $student['lname']; ?>"
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
                           value="<?php echo $student['fname']; ?>"
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
                           value="<?php echo $student['patronymic']; ?>"
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
                           value="<?php echo $student['birthdate']; ?>"
                           required>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-arrows-rotate me-2"></i>Yangilash
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