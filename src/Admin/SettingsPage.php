<?php

namespace RP\WordPress\CustomMaintenanceMode\Admin;

class SettingsPage {
    public function add_admin_menu() {
        add_options_page(
            'Custom Maintenance Mode Settings',
            'Maintenance Mode',
            'manage_options',
            'cmm-settings',
            [$this, 'settings_page']
        );
    }

    public function register_settings() {
        register_setting('cmm_settings_group', 'cmm_enable_maintenance_mode');
        register_setting('cmm_settings_group', 'cmm_maintenance_heading');
        register_setting('cmm_settings_group', 'cmm_maintenance_message');
    }

    public function settings_page() {
?>
        <div class="wrap">
            <h1>Custom Maintenance Mode Settings</h1>
            <form method="post" action="options.php">
                <?php settings_fields('cmm_settings_group'); ?>
                <?php do_settings_sections('cmm_settings_group'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Enable Maintenance Mode</th>
                        <td><input type="checkbox" name="cmm_enable_maintenance_mode" value="1" <?php checked(1, get_option('cmm_enable_maintenance_mode'), true); ?> /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Maintenance Heading</th>
                        <td><input type="text" name="cmm_maintenance_heading" value="<?php echo esc_attr(get_option('cmm_maintenance_heading', 'Under Maintenance')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Maintenance Message</th>
                        <td>
                            <?php
                            $content = get_option('cmm_maintenance_message', 'We are currently performing scheduled maintenance. Please check back later.');
                            $editor_id = 'cmm_maintenance_message';
                            $settings = [
                                'textarea_name' => 'cmm_maintenance_message',
                                'media_buttons' => false,
                                'textarea_rows' => 10,
                                'teeny'         => true,
                            ];
                            wp_editor($content, $editor_id, $settings);
                            ?>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
<?php
    }
}
