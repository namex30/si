<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "si";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_salle = $_POST['id_salle'] ?? '';
$id_abo = $_POST['id_abo'] ?? '';
$nom_membre = $_POST['nom_membre'] ?? '';
$prenom_membre = $_POST['prenom_membre'] ?? '';
$adresse_membre = $_POST['adresse_membre'] ?? '';
$tele_membre = $_POST['tele_membre'] ?? '';

if (!empty($id_salle) && !empty($id_abo) && !empty($nom_membre) && !empty($prenom_membre) && !empty($adresse_membre) && !empty($tele_membre)) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO membre (id_salle, id_abo, nom_membre, prenom_membre, adresse_membre, tele_membre) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $id_salle, $id_abo, $nom_membre, $prenom_membre, $adresse_membre, $tele_membre);

    // Execute the query
    if ($stmt->execute()) {
        echo "New member added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "All fields are required.";
}

// Close the connection
$conn->close();
?>
