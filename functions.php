<?php 
add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');
function register_user_front_end() {
	  $new_user_name = stripcslashes($_POST['new_user_name']);
	  $new_user_email = stripcslashes($_POST['new_user_email']);
	  $new_user_password = $_POST['new_user_password'];
	  $user_nice_name = strtolower($_POST['new_user_email']);
	  $user_data = array(
	      'user_login' => $new_user_name,
	      'user_email' => $new_user_email,
	      'user_pass' => $new_user_password,
	      'user_nicename' => $user_nice_name,
	      'display_name' => $new_user_first_name,
	      'role' => 'subscriber'
	  	);
	  $user_id = wp_insert_user($user_data);
	  	if (!is_wp_error($user_id)) {
	      echo 'we have Created an account for you.';
	  	} else {
	    	if (isset($user_id->errors['empty_user_login'])) {
	          $notice_key = 'User Name and Email are mandatory';
	          echo $notice_key;
	      	} elseif (isset($user_id->errors['existing_user_login'])) {
	          echo'User name already exixts.';
	      	} else {
	          echo'Error Occured please fill up the sign up form carefully.';
	      	}
	  	}
	die;
}