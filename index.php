<?php
require_once('../../config.php'); // Include Moodle configuration
require_once('functions.php'); // Include custom functions: generateTableUsersCourses

// Check if the user is logged in and is an administrator
require_login();
if (!is_siteadmin()) {
    print_error('accessdenied', 'admin');
}

// Set up the page
$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/report/mjreport/index.php'));
$PAGE->set_heading('MJ Report');

// Display the page header
echo $OUTPUT->header();

// Perform query - Fetch random users
$random_users = $DB->get_records_sql('SELECT * FROM {user} ORDER BY RAND() LIMIT 10');

// Generate HTML - Display users and courses in a table
generateTableUsersCourses($random_users);

// Display the page footer
echo $OUTPUT->footer();
?>
