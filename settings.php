<?php
defined('MOODLE_INTERNAL') || die;

// Just a link to course report.
$ADMIN->add(
        'reports', 
        new admin_externalpage(
                'reportmjreport', 
                'MJ Report', 
                $CFG->wwwroot . "/report/mjreport/index.php")
        );
// No report settings.
$settings = null;

