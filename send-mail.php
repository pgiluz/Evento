<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    $to = "gilardoni.p@gmail.com"; // La tua email
    $subject = "Nuova iscrizione all'evento";
    $message = "Hai ricevuto una nuova iscrizione:\n\n" .
               "Nome e Cognome: $name\n" .
               "Email: $email\n" .
               "Telefono: $phone\n";
    $headers = "From: no-reply@tuodominio.com\r\n" .
               "Reply-To: $email\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Iscrizione inviata con successo!";
    } else {
        echo "Errore nell'invio dell'iscrizione.";
    }
} else {
    echo "Metodo di richiesta non valido.";
}
?>
