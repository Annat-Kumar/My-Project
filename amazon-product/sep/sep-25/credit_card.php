<?php 
/* Plugin Name: Credit card settings*/

// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

	//create new top-level menu
	add_menu_page('Credit Card Settings', 'Credit Card Settings', 'administrator', __FILE__, 'my_cool_plugin_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
    register_setting( 'my-cool-plugin-settings-group', 'client_id' );
    register_setting( 'my-cool-plugin-settings-group', 'client_secret' );
    register_setting( 'my-cool-plugin-settings-group', 'account_id' );
    register_setting( 'my-cool-plugin-settings-group', 'access_token' );
	register_setting( 'my-cool-plugin-settings-group', 'credit_card_name' );
	register_setting( 'my-cool-plugin-settings-group', 'credit_card_email' );
	register_setting( 'my-cool-plugin-settings-group', 'credit_card_number' );
    register_setting( 'my-cool-plugin-settings-group', 'credit_card_month' );
    register_setting( 'my-cool-plugin-settings-group', 'credit_card_year' );
    register_setting( 'my-cool-plugin-settings-group', 'credit_card_cvv' );
    register_setting( 'my-cool-plugin-settings-group', 'postal_code' );
}

function my_cool_plugin_settings_page() {
?>
<div class="wrap">
<h1>Credit Card Settings</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
    <table class="form-table">

       <tr valign="top">
        <th scope="row">WePay Client ID</th>
        <td><input type="text" name="client_id" value="<?php echo esc_attr( get_option('client_id') ); ?>" />
       </td>
        </tr>

    <tr valign="top">
        <th scope="row">WePay Client Secret</th>
        <td><input type="text" name="client_secret" value="<?php echo esc_attr( get_option('client_secret') ); ?>" />
       </td>
        </tr>


    <tr valign="top">
        <th scope="row">WePay Account ID</th>
        <td><input type="text" name="account_id" value="<?php echo esc_attr( get_option('account_id') ); ?>" />
       </td>
        </tr>


    <tr valign="top">
        <th scope="row">WePay Access Token</th>
        <td><input type="text" name="access_token" value="<?php echo esc_attr( get_option('access_token') ); ?>" />
       </td>
        </tr>

        <tr valign="top">
        <th scope="row">Name</th>
        <td><input type="text" name="credit_card_name" value="<?php echo esc_attr( get_option('credit_card_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Email</th>
        <td><input type="text" name="credit_card_email" value="<?php echo esc_attr( get_option('credit_card_email') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Credit Card Number</th>
        <td><input type="text" name="credit_card_number" value="<?php echo esc_attr( get_option('credit_card_number') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Expiration Month:</th>
        <td><input type="text" name="credit_card_month" value="<?php echo esc_attr( get_option('credit_card_month') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Expiration Year</th>
        <td><input type="text" name="credit_card_year" value="<?php echo esc_attr( get_option('credit_card_year') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">CVV: </th>
        <td><input type="text" name="credit_card_cvv" value="<?php echo esc_attr( get_option('credit_card_cvv') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Postal Code: </th>
        <td><input type="text" name="postal_code" value="<?php echo esc_attr( get_option('postal_code') ); ?>" /></td>
        </tr>

    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>