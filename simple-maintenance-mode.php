<?php
/**
 * Plugin Name: Simple Maintenance Mode by Quiet Bolt
 * Description: Enables a clean maintenance mode with editable title, message, and icon.
 * Version: 1.0
 * Author: Quiet Bolt
 * Author URI: https://github.com/quietbolt
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: qb-smm
 */

if (!defined('ABSPATH')) exit;

// Display maintenance mode to visitors
function qb_smm_maintenance_mode() {
    if (!current_user_can('edit_themes') || !is_user_logged_in()) {
        $enabled     = get_option('qb_smm_enabled', '0');
        $title       = get_option('qb_smm_title', 'Maintenance Mode');
        $message     = get_option('qb_smm_message', 'We are currently undergoing maintenance. Please check back soon.');
        $show_icon   = get_option('qb_smm_show_icon', '1');

        if ($enabled === '1') {
            $icon = $show_icon === '1' ? '🔧 ' : '';
            wp_die(
                '<div style="text-align:center; margin-top: 100px;">
                    <h1 style="font-size:32px;">' . esc_html($icon . $title) . '</h1>
                    <p style="font-size:18px;">' . esc_html($message) . '</p>
                </div>',
                esc_html__('Maintenance Mode', 'qb-smm'),
                array('response' => 503)
            );
        }
    }
}
add_action('template_redirect', 'qb_smm_maintenance_mode');

// Admin Menu
function qb_smm_admin_menu() {
    add_menu_page(
        __('Maintenance Mode Settings', 'qb-smm'),
        __('Maintenance', 'qb-smm'),
        'manage_options',
        'qb-smm-settings',
        'qb_smm_settings_page',
        'dashicons-admin-tools',
        90
    );
}
add_action('admin_menu', 'qb_smm_admin_menu');

// Admin Settings Page
function qb_smm_settings_page() {
    if (isset($_POST['qb_smm_save'])) {
        update_option('qb_smm_enabled', isset($_POST['qb_smm_enabled']) ? '1' : '0');
        update_option('qb_smm_title', sanitize_text_field($_POST['qb_smm_title']));
        update_option('qb_smm_message', sanitize_textarea_field($_POST['qb_smm_message']));
        update_option('qb_smm_show_icon', isset($_POST['qb_smm_show_icon']) ? '1' : '0');
        echo '<div class="updated"><p>' . __('Settings saved!', 'qb-smm') . '</p></div>';
    }

    $enabled    = get_option('qb_smm_enabled', '0');
    $title      = get_option('qb_smm_title', 'Maintenance Mode');
    $message    = get_option('qb_smm_message', 'We are currently undergoing maintenance. Please check back soon.');
    $show_icon  = get_option('qb_smm_show_icon', '1');
    ?>
    <div class="wrap">
        <h1><?php _e('Simple Maintenance Mode by Quiet Bolt', 'qb-smm'); ?></h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('Enable Maintenance Mode', 'qb-smm'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="qb_smm_enabled" value="1" <?php checked($enabled, '1'); ?>>
                            <?php _e('Yes, enable maintenance mode', 'qb-smm'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Page Title', 'qb-smm'); ?></th>
                    <td>
                        <input type="text" name="qb_smm_title" value="<?php echo esc_attr($title); ?>" style="width: 400px;">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Show 🔧 Icon with Title', 'qb-smm'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="qb_smm_show_icon" value="1" <?php checked($show_icon, '1'); ?>>
                            <?php _e('Yes, show icon', 'qb-smm'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Maintenance Message', 'qb-smm'); ?></th>
                    <td>
                        <textarea name="qb_smm_message" rows="5" cols="50"><?php echo esc_textarea($message); ?></textarea>
                    </td>
                </tr>
            </table>
            <p>
                <input type="submit" name="qb_smm_save" class="button button-primary" value="<?php esc_attr_e('Save Settings', 'qb-smm'); ?>">
            </p>
        </form>
    </div>
    <?php
}
