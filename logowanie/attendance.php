<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
</head>
<body>
    <h1>Proszę zaznaczyć obecność na następnych zajęciach</h1>
    
    <!-- Formularz obecności -->
    <form action="submit_attendance.php" method="post">
        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" required>
        
        <p></p>
        <input type="radio" id="present" name="status" value="present" required>
        <label for="present">Obecność</label><br>
        
        <input type="radio" id="absent" name="status" value="absent">
        <label for="absent">Nieobecność</label><br><br>
        
        <button type="submit">Prześlij</button>
    </form>
    
    <h2>Sprawdź datę wygaśnięcia karnetu:</h2>
    
    <!-- Formularz sprawdzania karnetu -->
    <form method="POST" action="">
        <label for="search_name">Imię i nazwisko:</label>
        <input type="text" id="search_name" name="search_name" placeholder="Wpisz imię i nazwisko" required>
        <button type="submit">Sprawdź</button>
    </form>

    <!-- Wyświetlanie wyników wyszukiwania -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_name'])) {
        
        $search_name = $_POST['search_name'];
        $search_expiration_date = "2030-12-31"; // Domyślna data wygaśnięcia
        
        echo "<h3>Wynik wyszukiwania:</h3>";
        echo "<p>";
        echo "Imię i nazwisko: <strong>" . htmlspecialchars($search_name) . "</strong><br>";
        echo "Data wygaśnięcia karnetu: <strong>" . htmlspecialchars($search_expiration_date) . "</strong>";
        echo "</p>";
    }
    ?>
</body>
</html>
