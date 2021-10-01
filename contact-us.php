<?php
/*
Plugin Name: Feedback Form Plugin
Plugin URI: https://www.linkedin.com/in/donaldafeith/
Description: Feedback form with validaton - sends email as well as posts responses to database and WP dashboard. Add [df_feedback_form] to any page or post to use the form
Version: 1.0
*/

if(!defined('WPINC'))
{
die;
}

// create table at plugin activition
register_activation_hook( __FILE__, 'df_create_db' );
function df_create_db() 
{
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name=$wpdb->prefix.'feedbackform';
	$sql="CREATE TABLE $table_name(
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT NULL,
		name varchar(50) DEFAULT NULL,
        telno varchar(20) DEFAULT NULL,
		email varchar(75) DEFAULT NULL,
        town varchar(75) DEFAULT NULL,
        device varchar(75) DEFAULT NULL,
		message text,
		UNIQUE KEY id (id)
		) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

//adding plugin to admin menu
add_action('admin_menu', 'df_menu');
function df_menu() 
{
 add_menu_page(__('Feedback Form','df'), __('Feedback Form','df'),
 	 'administrator', 'df-feedback-form', 'df_settings_page', 'dashicons-email');
	function df_settings_page() 
	 {
	 	global $wpdb;
	 	$table_name=$wpdb->prefix.'feedbackform';
	 	$client_msg = $wpdb->get_results( 
			"
			SELECT *
			FROM $table_name
			"
		);
	 	require_once(plugin_dir_path(__FILE__).'settings-page.php');
	 }
	 
}

function feedback_df()
{
 ob_start();
 require_once(plugin_dir_path(__FILE__).'form.php');
 return ob_get_clean();
}
add_shortcode( 'df_feedback_form', 'feedback_df' );

//if you want to have both logged in and not logged in users submitting, you have to add both actions!
add_action( 'admin_post_add_foobar', 'df_admin_add_foobar' );
add_action( 'admin_post_nopriv_add_foobar', 'df_admin_add_foobar' );
function df_admin_add_foobar() {
    global $wpdb;
    $data = array(
        'time'  => current_time('mysql'),
        'name'  => sanitize_text_field( $_POST['name'] ),
        'telno'  => sanitize_text_field( $_POST['telno']),
        'email' => isset( $_POST['email'] ) ? sanitize_email( $_POST['email']) : null,
        'town'  => sanitize_text_field( $_POST['town']),
        'device'  => sanitize_text_field( $_POST['device']),
        'message'   => sanitize_text_field( $_POST['message'])
    );

    $table_name = $wpdb->prefix.'feedbackform';
    $headers = array( 'Content-Type: text/html; charset=UTF-8' );
    // send Email for admin
    wp_mail(
        get_option( 'admin_email' ),
        'Instant Feedback Form',
        'Time : ' . $data['time'] .
        'Name : ' . $data['name'] .
        'Tel No : ' . $data['telno'] .
        'Email : ' . $data['email'] .
        'City : ' . $data['town'] .
        'Device : ' . $data['device'] .
        'The message: ' . $data['message'],         
        $headers
    );

    if ( $wpdb->insert( $table_name, $data ) ) {
        $_SESSION['message'] = "";
    } else {
        $_SESSION['message'] = "";
    }
    //redirect back to where user was comming
    wp_redirect( $_SERVER['HTTP_REFERER'] );
    //request handlers should die() when they complete their task
}

?>