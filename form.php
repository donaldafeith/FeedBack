<form name='message' id='message' class="contactusform" enctype="multipart/form-data" action="<?php echo esc_attr( admin_url('admin-post.php') ); ?>" method="POST">
<?php
$current_user = wp_get_current_user();
 
/*
 * @example Safe usage: $current_user = wp_get_current_user();
 * if ( ! ( $current_user instanceof WP_User ) ) {
 *     return;
 * }

printf( __( 'Username: %s', 'textdomain' ), esc_html( $current_user->user_login ) ) . '<br />';
printf( __( 'User email: %s', 'textdomain' ), esc_html( $current_user->user_email ) ) . '<br />';
printf( __( 'User first name: %s', 'textdomain' ), esc_html( $current_user->user_firstname ) ) . '<br />';
printf( __( 'User last name: %s', 'textdomain' ), esc_html( $current_user->user_lastname ) ) . '<br />';
printf( __( 'User display name: %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';
printf( __( 'User ID: %s', 'textdomain' ), esc_html( $current_user->ID ) );
 */
 ?>
<?php
 if(isset($_SESSION['message']))
 {
 echo $_SESSION['message'];
 unset($_SESSION['message']);
 }
 ?>
    <input type="hidden" name="action" value="add_foobar">
    <input type="hidden" name="data" value="foobarid">
    <label>Full Name:</label>
    <input type="text" name="name" value="<? printf( __( '%s', 'textdomain' ), esc_html( $current_user->user_login ) ) ?>" required="">
    <label>Phone Number:</label>
    <input type="text" name="telno" id="telno">
    <label>Email Address:</label>
    <input type="email" name="email" value="<? printf( __( '%s', 'textdomain' ), esc_html( $current_user->user_email ) ) ?>" required="">
    <label>Town:</label>
    <input type="text" name="town" value="" required="">
    <label>Device:</label>
    <select name="device" value="" required="">
        <option selected="selected" value=""></option>
        <option value="Not Sure">Not Sure</option>
        <option selected="selected" value=""></option>
        <option value="iPhone 3G">Windows</option>
        <option value="iPhone 3G">Mac</option>
		<option value="iPhone 3G">Linux</option>
		<option value="iPhone 3G">Unsure</option>
    </select>
    <label>Message:</label>
    <textarea name="message" cols="30" rows="4" value="" required=""></textarea>
    <input class="submit2" type='submit' id='submit' value='Send Message' />
</form>
<div id='simple-msg'></div>