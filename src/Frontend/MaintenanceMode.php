<?php

namespace RP\WordPress\CustomMaintenanceMode\Frontend;

class MaintenanceMode {
    public function __construct() {
        add_action('template_redirect', [$this, 'check_maintenance_mode']);
    }

    public function check_maintenance_mode() {
        if (get_option('cmm_enable_maintenance_mode') && !current_user_can('administrator') && !is_user_logged_in()) {
            $heading = get_option('cmm_maintenance_heading', 'Under Maintenance');
            $message = get_option('cmm_maintenance_message', 'We are currently performing scheduled maintenance. Please check back later.');

            $custom_styles = "
                <style>
                    .maintenance-container {
                        font-family: Arial, sans-serif;
                    }
                    .maintenance-container h1 {
                        font-size: 36px;
                        color: #333;
                    }
                    .maintenance-container p {
                        font-size: 18px;
                        color: #666;
                    }
                </style>
            ";

            $message_html = "
                <div class='maintenance-container'>
                    <h1>" . esc_html($heading) . "</h1>
                    <div>" . wp_kses_post($message) . "</div>
                </div>
            ";

            wp_die($custom_styles . $message_html, 'Maintenance Mode', ['response' => 503]);
        }
    }
}
