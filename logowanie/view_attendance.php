<?php
$host = '127.0.0.1';
$dbname = 'bazafit';
$user = 'root';
$password = 'Admin123'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('<h1>Błąd połączenia: ' . $e->getMessage() . '</h1>');
}

// Odczyt obecności z pliku
$file = 'attendance_data.txt';
$present = [];
if (file_exists($file)) {
    $data = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($data as $line) {
        $parts = explode('|', $line);
        if (count($parts) === 2 && $parts[1] === 'present') {
            $present[] = $parts[0];
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
	<head>
    <title>Panel Admina - JustFit</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    
    <style>
        
        #addKarnetForm input[type="text"], 
        #addKarnetForm input[type="date"] {
            color: #333333 !important; 
            background-color: #ffffff !important; 
            border: 1px solid #cccccc !important;
        }

        
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: none !important; 
            cursor: pointer;
        }

        
        #addKarnetForm input:focus {
            color: #000000 !important;
            background-color: #f0f0f0 !important;
        }
    </style>
</head>
	<body class="is-preload">
		<div id="page-wrapper">
			<header id="header">
				<h1><a href="../index.html">JustFit</a></h1>
			</header>

			<article id="main">
				<header>
					<h2>Zarządzanie Klubem</h2>
					<p>Dodawaj użytkowników i sprawdzaj obecność</p>
				</header>
				<section class="wrapper style5">
					<div class="inner">

						<section>
							<h4>Lista Obecnych</h4>
							<ul>
								<?php foreach ($present as $p): ?>
									<li><?php echo htmlspecialchars($p); ?> - <span style="color: #2ecc71;">Obecny</span></li>
								<?php endforeach; ?>
							</ul>
							<form action="clear_attendance.php"><button class="button small">Wyczyść listę</button></form>
						</section>

						<hr />

						<section>
							<h4>Dodaj Nowego Użytkownika i Karnet</h4>
							<form id="addKarnetForm">
								<div class="row gtr-uniform">
									<div class="col-4 col-12-xsmall">
										<input type="text" id="k_name" placeholder="Imię i nazwisko" required />
									</div>
									<div class="col-4 col-12-xsmall">
										<input type="text" id="k_number" placeholder="Numer karnetu (login)" required />
									</div>
									<div class="col-4 col-12-xsmall">
										<input type="date" id="k_date" required />
									</div>
									<div class="col-12">
										<button type="button" onclick="sendData()" class="primary">Zapisz w systemie</button>
									</div>
								</div>
							</form>
						</section>
						
						<ul class="actions stacked" style="margin-top: 50px;">
							<li><a href="../index.html" class="button fit">Powrót do strony głównej</a></li>
						</ul>
					</div>
				</section>
			</article>
		</div>

		<script src="../assets/js/jquery.min.js"></script>
		<script>
		function sendData() {
			var nameVal = $('#k_name').val();
			var numVal = $('#k_number').val();
			var dateVal = $('#k_date').val();

			if(!nameVal || !numVal || !dateVal) {
				alert("Proszę wypełnić wszystkie pola!");
				return;
			}

			$.ajax({
				url: 'saveToBazaFit.php',
				type: 'POST',
				data: { 
					name: nameVal, 
					membership_number: numVal, 
					expiration_date: dateVal 
				},
				success: function(response) {
					alert("✅ " + response);
					$('#addKarnetForm')[0].reset();
				},
				error: function(xhr) {
					alert("❌ Błąd serwera: " + xhr.responseText);
				}
			});
		}
		</script>
	</body>
</html>