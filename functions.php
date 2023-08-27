<?php
// Function to get all courses for a specific user and terutn them as a array of strings separated with comma
function getCoursesNames($user){
    // Get array with all courses (objects) for specific user
    $courses = enrol_get_users_courses($user->id);
    // Set array of courses names as empty array
    $coursesNames = [];
    // Loop through all courses and push full name to array
    foreach ($courses as $course) {
        array_push($coursesNames, $course->fullname);
    }
    // Join elements of an array with comma + space and return
    return implode(', ', $coursesNames);
}
// Function to generate HTML of a table with users and courses
function generateTableUsersCourses($users){
    echo '<h2>Random Users:</h2>
        <table>
            <tr>
                <th>User</th>
                <th>Courses</th>
            </tr>';

    // Loop to print random users and all courses for each user
    foreach ($users as $user) {
        echo '<tr>
                <td>' . fullname($user) . '</td>
                <td> ' . getCoursesNames($user) . '</td>
            </tr>';
    }
    echo '</table>';
}
?>