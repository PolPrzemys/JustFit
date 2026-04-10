<?php
$host = '127.0.0.1';
$dbname = 'bazafit'; 
$username = 'root'; 
$password = 'Admin123'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_input = $_POST['username'] ?? '';

        if ($user_input === 'admin') {
            $role = 'admin';
            $welcome_name = "Szefie (Administratorze)";
        } else {
            $stmt = $pdo->prepare("SELECT name FROM users WHERE membership_number = :user");
            $stmt->execute([':user' => $user_input]);
            $user = $stmt->fetch();
            $role = $user ? 'user' : null;
            $welcome_name = $user ? $user['name'] : null;
        }

        if ($welcome_name) {
            ?>
            <!DOCTYPE HTML>
            <html>
                <head>
                    <title>Panel JustFit - <?php echo $role === 'admin' ? 'ADMIN' : 'KLIENT'; ?></title>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
                    <link rel="stylesheet" href="../assets/css/main.css" />
                </head>
                <body class="is-preload">
                    <div id="page-wrapper">
                        <header id="header">
                            <h1><a href="../index.html">JustFit</a></h1>
                        </header>

                        <article id="main">
                            <header>
                                <h2>Witaj, <?php echo htmlspecialchars($welcome_name); ?>!</h2>
                                <p><?php echo $role === 'admin' ? 'Zalogowano do Panelu Zarządzania' : 'Zalogowano do Strefy Klienta'; ?></p>
                            </header>
                            
                            <section class="wrapper style5">
                                <div class="inner">
                                    
                                    <?php if ($role === 'admin'): ?>
                                        <h3>🛠️ Panel Administracyjny</h3>
                                        <p>Masz pełny dostęp do zarządzania klubem. Wybierz akcję:</p>
                                        <ul class="actions">
                                            <li><a href="view_attendance.php" class="button primary">Zarządzaj Karnetami i Obecnością</a></li>
                                            <li><a href="clear_attendance.php" class="button">Wyczyść Listę Obecności</a></li>
                                        </ul>
                                    <?php else: ?>
                                        <h3>📋 Twoje Konto</h3>
                                        <p>Twoje członkostwo jest aktywne. Pamiętaj o regularnych treningach!</p>
                                        <ul class="actions">
                                            <li><a href="../index.html" class="button primary">Powrót do strony głównej</a></li>
                                        </ul>
                                    <?php endif; ?>

                                    <hr />
                                    <ul class="actions stacked">
                                        <li><a href="../login.html" class="button fit">Wyloguj się</a></li>
                                    </ul>
                                </div>
                            </section>
                        </article>
                    </div>
                    <script src="../assets/js/jquery.min.js"></script>
                    <script src="../assets/js/main.js"></script>
                </body>
            </html>
            <?php
            exit;
        } else {
            header("Location: ../login.html?error=invalid");
            exit;
        }
    }
} catch (PDOException $e) {
    die("Błąd systemu: " . $e->getMessage());
}