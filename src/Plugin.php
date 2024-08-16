<?php

namespace RP\WordPress\CustomMaintenanceMode;

use RP\WordPress\CustomMaintenanceMode\Admin\SettingsPage;
use RP\WordPress\CustomMaintenanceMode\Frontend\MaintenanceMode;

class Plugin {
    public function run() {
        $this->initialize_hooks();
    }

    private function initialize_hooks() {
        if (is_admin()) {
            $settings_page = new SettingsPage();
            add_action('admin_menu', [$settings_page, 'add_admin_menu']);
            add_action('admin_init', [$settings_page, 'register_settings']);
        } else {
            $maintenance_mode = new MaintenanceMode();
            add_action('get_header', [$maintenance_mode, 'check_maintenance_mode']);
        }
    }
}
