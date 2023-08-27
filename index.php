<?php
require_once('../../config.php'); // Include Moodle configuration

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

// Fetch random users
$random_users = $DB->get_records_sql('SELECT * FROM {user} ORDER BY RAND() LIMIT 10');

// Display user information
echo '<h2>Random Users</h2>
        <table>
            <tr>
                <th>User</th>
                <th>Courses</th>
            </tr>';

// Double loop to print random users and all courses for each user
foreach ($random_users as $user) {
    echo '<tr>
            <td>' . fullname($user) . '</td>
            <td>';
    // Get array with all courses for specific user
    $courses = enrol_get_users_courses($user->id);
    // Lenght of the array with courses - number of courses for specific user
    $lenght = count($courses);
    // Index of first course
    $index = 1;
    foreach ($courses as $course) {
        // If this is the last course it should end without comma
        if ($index == $lenght) {
            echo $course->fullname; 
        }
        // If the course is not the last then it should be separated by a comma for clarity of view in the table
        else{
            echo $course->fullname.', ';
        }
        $index = $index + 1;                
    }
    echo '</td>
        </tr>';
}
echo '</table>';

// Display the page footer
echo $OUTPUT->footer();
?>
