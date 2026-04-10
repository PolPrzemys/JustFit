<?php
$host = '127.0.0.1';
$dbname = 'bazafit'; 
$username = 'root'; 
$password = 'Admin123'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $membership_number = $_POST['membership_number'] ?? '';
    $expiration_date = $_POST['expiration_date'] ?? '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Transakcja: albo obie tabele, albo żadna
        $pdo->beginTransaction();

        // 1. Dodanie do users 
        $stmt1 = $pdo->prepare("INSERT INTO users (name, membership_number) VALUES (:name, :number)");
        $stmt1->execute([':name' => $name, ':number' => $membership_number]);

        // 2. Dodanie do karnety 
        $stmt2 = $pdo->prepare("INSERT INTO karnety (name, expiration_date) VALUES (:name, :date)");
        $stmt2->execute([':name' => $name, ':date' => $expiration_date]);

        $pdo->commit();
        echo "Użytkownik " . htmlspecialchars($name) . " został dodany!";
    } catch (PDOException $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        http_response_code(500);
        echo "Błąd: " . $e->getMessage();
    }
}
?>