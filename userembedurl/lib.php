<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/adminlib.php'); // Load Moodle's admin library
require_once($CFG->libdir.'/moodlelib.php'); // Load Moodle's core library for context classes

function userembedurl_extend_navigation(global_navigation $nav) {
    global $USER, $PAGE;

    // Add a custom node to the navigation.
    $node = $nav->add(get_string('userembedurl', 'local_userembedurl'), new moodle_url('/local/userembedurl/index.php'));
    $node->showinflatnavigation = true;
}

function local_userembedurl_user_embed_url() {
    global $USER, $DB;

    // Query the URL from the database based on the user ID.
    $record = $DB->get_record('local_userembedurl_urls', array('userid' => $USER->id), 'url');

    return $record ? $record->url : 'https://example.com/embed/default';
}
