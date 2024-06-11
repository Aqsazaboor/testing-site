<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// define the woocommerce_process_login_errors callback 
if(!function_exists("nb_filter_woocommerce_process_login_errors")) {
    function nb_filter_woocommerce_process_login_errors($validation_error, $post_username, $post_password) {
        //if (strpos($post_username, '@') == FALSE)
        if (!filter_var($post_username, FILTER_VALIDATE_EMAIL)) //<--recommend option
        {
            throw new Exception( '<strong>' . __( 'Error', 'woocommerce' ) . ':</strong> ' . __( 'Please Enter a Valid Email ID.', 'woocommerce' ) );
        }
        return $validation_error;
    }
    add_filter('woocommerce_process_login_errors', 'nb_filter_woocommerce_process_login_errors', 10, 3);
}

/*
add_filter('gettext', function($text){
    if(in_array($GLOBALS['pagenow'], array('wp-login.php'))){
        if('Username' == $text){
            return 'Email';
        }
    }
    return $text;
}, 20);
*/


/*

class DisableMailChange
{

    public function __construct()
    {
        //prevent email change
        add_action( 'personal_options_update',  [$this, 'disable_mail_change_BACKEND'], 5  );
        add_action( 'show_user_profile',        [$this, 'disable_mail_change_HTML']  ); 
    }

    public function disable_mail_change_BACKEND($user_id) {
        if ( !current_user_can( 'manage_options' ) ) { 
            $user = get_user_by('id', $user_id ); $_POST['email']=$user->user_email; 
        } 
    }

    public function disable_mail_change_HTML($user) {
        if ( !current_user_can( 'manage_options' ) ) { 
            echo '<script>document.getElementById("email").setAttribute("disabled","disabled");</script>';
        } 
    }
}
new DisableMailChange();
*/


/*
remove_filter('authenticate', 'wp_authenticate_username_password', 20);
add_filter('authenticate', function($user, $email, $password){

    //Check for empty fields
    if(empty($email) || empty ($password)){        
        //create new error object and add errors to it.
        $error = new WP_Error();

        if(empty($email)){ //No email
            $error->add('empty_username', __('<strong>ERROR</strong>: Email field is empty.'));
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //Invalid Email
            $error->add('invalid_username', __('<strong>ERROR</strong>: Email is invalid.'));
        }

        if(empty($password)){ //No password
            $error->add('empty_password', __('<strong>ERROR</strong>: Password field is empty.'));
        }

        return $error;
    }

    //Check if user exists in WordPress database
    $user = get_user_by('email', $email);

    //bad email
    if(!$user){
        $error = new WP_Error();
        $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
        return $error;
    }
    else{ //check password
        if(!wp_check_password($password, $user->user_pass, $user->ID)){ //bad password
            $error = new WP_Error();
            $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
            return $error;
        }else{
            return $user; //passed
        }
    }
    
}, 20, 3);


add_filter('gettext', function($text){
    if(in_array($GLOBALS['pagenow'], array('wp-login.php'))){
        if('Username' == $text){
            return 'Email';
        }
    }
    return $text;
}, 20);
*/