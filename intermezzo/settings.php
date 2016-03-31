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
 * Defines settings entries.
 *
 * Defines a new settings page and where in the tree to place.
 * Then defines what controls to place and maps them to settings,
 * in this case it is mapped to the global $CFG->login_intermezzo
 * setting.
 *
 * @package    intermezzo
 * @copyright  2016 Royal Australasian College of Surgeons
 * @author     Darren Cocco <darren.cocco@surgeons.org>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
if ($hassiteconfig) { // needs this condition or there is error on login page
    $settings = new admin_settingpage('local_intermezzo', get_string('pluginname', 'local_intermezzo'));
    $ADMIN->add('localplugins', $settings);

    $settings->add(new admin_setting_configtext('login_intermezzo',
        get_string('setting_landingpage', 'local_intermezzo'),
        get_string('setting_landingpage_description', 'local_intermezzo'),
        "/local/intermezzo_demo/index.php"));
}