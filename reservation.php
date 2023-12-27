<?php
/*
Plugin Name: Plugin reservation wordpress
Description: Plugin permettant aux utilisateurs de réserver un créneau par jour.
Version: 1.0
Author: Romain Philip
*/

// Fonction pour ajouter le formulaire de réservation
function reservation_form_shortcode() {
    ob_start();
    ?>
    <form method="post" action="">
        <label for="first_name">Prénom :</label>
        <input type="text" name="first_name" required><br>

        <label for="last_name">Nom :</label>
        <input type="text" name="last_name" required><br>

        <label for="email">E-mail :</label>
        <input type="email" name="email" required><br>

        <label for="date">Date :</label>
        <input type="date" name="reservation_date" required><br>

        <input type="submit" name="submit_reservation" value="Réserver">
    </form>
    <?php
    return ob_get_clean();
}

// Enregistrez le shortcode pour afficher le formulaire
add_shortcode('reservation_form', 'reservation_form_shortcode');

// Fonction pour traiter la soumission du formulaire
function process_reservation_form() {
    if (isset($_POST['submit_reservation'])) {
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $email = sanitize_email($_POST['email']);
        $reservation_date = sanitize_text_field($_POST['reservation_date']);

        // Enregistrez les informations dans la base de données (à implémenter)

        function send_reservation_email($first_name, $last_name, $email, $reservation_date) {
            $to = get_option('admin_email');
            $subject = 'Nouvelle réservation';
            $message = sprintf(
                "Nouvelle réservation :\n\nNom : %s\nPrénom : %s\nE-mail : %s\nDate de réservation : %s",
                $last_name,
                $first_name,
                $email,
                $reservation_date
            );
        
            wp_mail($to, $subject, $message);
        }
    }
}

// Ajoutez une action pour traiter la soumission du formulaire
add_action('init', 'process_reservation_form');