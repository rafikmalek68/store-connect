<?php
// create custom plugin settings menu
add_action('admin_menu', 'ar_plugin_create_menu');

function ar_plugin_create_menu() {
    add_menu_page(  'SC Setting', 'SC Setting', 'administrator', 'sc-setting', 'sc_plugin_settings_page', 'dashicons-chart-area', 26 );
	//call register settings function
	add_action( 'admin_init', 'register_ar_plugin_settings' );
}


function register_ar_plugin_settings() {
	//register our settings
	register_setting( 'sc-settings-group', 'sc_setting' );

}

function sc_plugin_settings_page() {
?>
<div class="wrap">
<h1>SC Settings</h1>

<form method="post" action="options.php">

    <?php 

    settings_fields( 'sc-settings-group' );
    do_settings_sections( 'sc-settings-group' );
    $sc_setting = get_option('sc_setting');
    $other_store_api_url = !empty($sc_setting['other_store_api_url'])?$sc_setting['other_store_api_url']:'';
    $other_store_consumer_key = !empty($sc_setting['other_store_consumer_key'])?$sc_setting['other_store_consumer_key']:'';
    $other_store_consumer_secret = !empty($sc_setting['other_store_consumer_secret'])?$sc_setting['other_store_consumer_secret']:'';

    ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Store API URL</th>
        <td>
            <p><?php echo site_url('/');?>wp-json/wc/v2/products</p>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Other store API URL</th>
        <td>
            <input type="text" class="" name="sc_setting[other_store_api_url]" value="<?php echo $other_store_api_url; ?>" />
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Other store Consumer key </th>
        <td>
            <input type="text" class="" name="sc_setting[other_store_consumer_key]" value="<?php echo $other_store_consumer_key; ?>" />
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Other store Consumer secret </th>
        <td>
            <input type="text" class="" name="sc_setting[other_store_consumer_secret]" value="<?php echo $other_store_consumer_secret; ?>" />
        </td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>

</div>
<?php }



