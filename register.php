<?php
// Configurazione database
$host = 'localhost';
$dbname = 'eventi';
$username = 'root';
$password = '';

// Connessione al database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connessione fallita: " . $e->getMessage());
}

// Recupero dati dal form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Salvataggio nel database
$sql = "INSERT INTO iscrizioni (name, email, phone) VALUES (:name, :email, :phone)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':phone', $phone);

if ($stmt->execute()) {
    // Invia email di notifica
    $to = 'gilardoni.p@gmail.com';
    $subject = 'Nuova iscrizione all\'evento';
    $message = "Nuova iscrizione ricevuta:\n\nNome: $name\nEmail: $email\nTelefono: $phone";
    $headers = "From: no-reply@tuosito.com";

    mail($to, $subject, $message, $headers);

    // Redirect con messaggio di successo
    header("Location: success.html");
} else {
    echo "Errore nell'iscrizione.";
}
?>
