<?php

/**
 * Plugin Name: WP-File-Block-Pdf-Icon
 * Description: Auto PDF icon add File blocks for Wordpress. It adds it to the download links button if files is of type pdf. Tested on Wordpress 6.2.
 * Version: 0.0.2
 * Plugin URI: https://github.com/zapobyte/wp-file-block-pdf-icon
 * Author: Victor
 * Author URI: https://github.com/zapobyte
 * 
 */

// Add a menu item for the plugin
function auto_icon_link_menu_plugin()
{
    add_menu_page(
        'WP-File-Block-Pdf-Icon',
        'WP-File-Block-Pdf-Icon',
        'manage_options',
        'my-class-checker',
        'my_class_checker_options_page',
        'dashicons-editor-code',
        99
    );
}
add_action('admin_menu', 'auto_icon_link_menu_plugin');

// Create the options page callback function
function my_class_checker_options_page()
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('my-class-checker-settings'); ?>
            <?php do_settings_sections('my-class-checker-settings'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="_my_class_checker_class_name">Class Names</label>
                    </th>
                    <td>
                        <input type="text" value="wp-block-file__button" id="_my_class_checker_class_name" name="_my_class_checker_class_name" value="<?php echo esc_attr(get_option('_my_class_checker_class_name', '')); ?>" />
                        <br>
                        <small>Input  class name you want the plugin to add the link for. Do not change it unless you have custom theme with file upload custom block theme. If so it do it like: <code>first-class</code></small>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// Register the settings for the options page
function my_class_checker_register_settings()
{
    register_setting('my-class-checker-settings', '_my_class_checker_class_name');
}
add_action('admin_init', 'my_class_checker_register_settings');

// Add the front-end class checker script
function my_class_checker_enqueue_scripts()
{
    $class_name = get_option('_my_class_checker_class_name', '');
    wp_enqueue_script(
        'my-class-checker',
        plugin_dir_url(__FILE__) . 'wp-file-block-pdf-icon.js',
        array('jquery'),
        '1.0.0',
        true
    );
    wp_localize_script(
        'my-class-checker',
        'MyClassCheckerSettings',
        array(
            'class_name' => $class_name
        )
    );
}
add_action('wp_enqueue_scripts', 'my_class_checker_enqueue_scripts');


// Helper function to check for a custom class
function has_class($class_name, $content)
{
    $classes = explode(' ', $class_name);
    foreach ($classes as $class) {
        if (strpos($content, $class) !== false) {
            return true;
        }
    }
    return false;
}
