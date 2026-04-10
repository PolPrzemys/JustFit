<?php
// Plik do przechowywania wyników (prosta metoda)
$file = 'attendance_data.txt';

// Sprawdzanie, czy dane zostały przesłane
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $status = htmlspecialchars($_POST['status']);

    // Zapisanie danych do pliku
    $entry = "$name|$status\n";
    file_put_contents($file, $entry, FILE_APPEND);

    echo "<h1>Dzięki, $name!</h1>";
    echo "<p>Status obecnośći potwierdzony</p>";
    echo '<a href="..\index.html">Powrót</a>';
}
?>
