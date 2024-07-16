<?php
require_once('../../config.php'); // Load the Moodle configuration file
require_once($CFG->libdir.'/adminlib.php'); // Load Moodle's admin library
require_once($CFG->libdir.'/moodlelib.php'); // Load Moodle's core library for context classes
require_once('lib.php'); // Load the Moodle configuration file


require_login();

$context = context_system::instance(); // Get the system context
require_capability('local/userembedurl:view', $context); // Check if the user has the required capability

$PAGE->set_url(new moodle_url('/local/userembedurl/index.php'));
$PAGE->set_context($context);
$PAGE->set_title(get_string('Database View', 'local_userembedurl'));
$PAGE->set_heading(get_string('Database View', 'local_userembedurl'));

$embedUrl = local_userembedurl_user_embed_url(); // Get the URL for the current user

echo $OUTPUT->header();
echo html_writer::tag('iframe', '', [
    'src' => $embedUrl,
    'width' => '100%',
    'height' => '750px',
    'frameborder' => '0',
    'allowfullscreen' => 'true'
]);
echo $OUTPUT->footer();
