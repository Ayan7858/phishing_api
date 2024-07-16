<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_userembedurl', get_string('userembedurl', 'local_userembedurl'));

    // Add settings fields here if needed.

    $ADMIN->add('localplugins', $settings);
}
