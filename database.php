<?php

// Création de la base de donnée

function create_reservation_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        first_name VARCHAR(25) NOT NULL,
        last_name VARCHAR(25) NOT NULL,
        email VARCHAR(30) NOT NULL,
        reservation_date DATE NOT NULL,
        reservation_time TIME NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_reservation_table' );

// Fonction pour enregistrer les informations dans la base de données 

function save_reservation_to_database($first_name, $last_name, $email, $reservation_date, $reservation_time) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'reservations';

    $data = array(
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'reservation_date' => $reservation_date,
        'reservation_time' => $reservation_time,
    );

    $format = array('%s', '%s', '%s', '%s', '%s');

    $wpdb->insert($table_name, $data, $format);
}