<?php
/* Include config file */
require_once "config.php";

/* Select all users from the database */
$sql = "SELECT id, password FROM users";
$result = mysqli_query($link, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['id'];
        $current_password = $row['password'];

        // Appliquer le nouvel algorithme de hachage
        $new_password = password_hash($current_password, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base de données
        $update_sql = "UPDATE users SET password = '$new_password' WHERE id = $user_id";
        mysqli_query($link, $update_sql);
    }

    echo "Mise à jour des mots de passe terminée avec succès.";
} else {
    echo "Erreur lors de la récupération des utilisateurs.";
}

/* Fermer la connexion */
mysqli_close($link);
?>

