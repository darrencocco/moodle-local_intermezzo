<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Landing page for the demo.
 *
 * The code under get_return_rule() is an exact copy
 * of that found in the login control code under
 * moodle_root/login/lib.php
 *
 * @package    intermezzo_demo
 * @copyright  2016 Royal Australasian College of Surgeons
 * @author     Darren Cocco <darren.cocco@surgeons.org>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once("../../config.php");

require_login(1);

$PAGE->set_pagelayout('login');
$PAGE->set_heading('User Confirmation');
$PAGE->set_title('User Confirmation');

$url = new moodle_url('/local/intermezzo_demo/index.php');
$PAGE->set_url($url);

echo $OUTPUT->header();

echo '<div class="local-intermezzo_demo-displaybox">';
echo '<div class="local-intermezzo_demo-content">';
echo "<h1>Hi, $USER->firstname $USER->lastname </h1>";
echo get_config("local_intermezzo_demo", "greeting");
echo "<div class'local-intermezzo_demo-buttonbox'>";
echo "<div class='local-intermezzo_demo-button'>".$OUTPUT->single_button(get_return_url(), 'Continue')."</div>";
echo "<div class='local-intermezzo_demo-button'>".$OUTPUT->single_button(new moodle_url('/login/logout.php', array('sesskey'=>sesskey())), "Logout")."</div>";
echo "</div>";
echo '</div>';
echo '</div>';

echo $OUTPUT->footer();

function get_return_url() {
    global $CFG, $SESSION, $USER;
    // Prepare redirection.

    if (user_not_fully_set_up($USER)) {
        $urltogo = $CFG->wwwroot.'/user/edit.php';
        // We don't delete $SESSION->wantsurl yet, so we get there later.

    } else if (isset($SESSION->wantsurl) and (strpos($SESSION->wantsurl, $CFG->wwwroot) === 0
        or strpos($SESSION->wantsurl, str_replace('http://', 'https://', $CFG->wwwroot)) === 0)) {
            $urltogo = $SESSION->wantsurl;    // Because it's an address in this site.
            unset($SESSION->wantsurl);
        } else {
            // No wantsurl stored or external - go to homepage.
            $urltogo = $CFG->wwwroot.'/';
            unset($SESSION->wantsurl);
        }

        // If the url to go to is the same as the site page, check for default homepage.
        if ($urltogo == ($CFG->wwwroot . '/')) {
            $homepage = get_home_page();
            // Go to my-moodle page instead of site homepage if defaulthomepage set to homepage_my.
            if ($homepage == HOMEPAGE_MY && !is_siteadmin() && !isguestuser()) {
                if ($urltogo == $CFG->wwwroot or $urltogo == $CFG->wwwroot.'/' or $urltogo == $CFG->wwwroot.'/index.php') {
                    $urltogo = $CFG->wwwroot.'/my/';
                }
            }
        }
        return $urltogo;
}