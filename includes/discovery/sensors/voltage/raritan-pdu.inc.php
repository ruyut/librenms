<?php

/**
 * raritan-pdu.inc.php
 *
 * LibreNMS voltage sensor discovery module for Raritan
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @link       https://www.librenms.org
 *
 * @copyright  2017 Neil Lathwood
 * @author     Neil Lathwood <gh+n@laf.io>
 */
foreach ($pre_cache['raritan_inletTable'] as $index => $raritan_data) {
    for ($x = 1; $x <= $raritan_data['inletPoleCount']; $x++) {
        $tmp_index = "$index.$x";
        $new_index = "inletPoleVoltage.$tmp_index";
        $oid = '.1.3.6.1.4.1.13742.4.1.21.2.1.4.' . $tmp_index;
        $descr = 'Inlet ' . $pre_cache['raritan_inletPoleTable'][$index][$x]['inletPoleLabel'];
        $divisor = 1000;
        $low_limit = $raritan_data['inletVoltageUpperCritical'] / $divisor;
        $low_warn_limit = $raritan_data['inletVoltageUpperWarning'] / $divisor;
        $warn_limit = $raritan_data['inletVoltageLowerWarning'] / $divisor;
        $high_limit = $raritan_data['inletVoltageLowerCritical'] / $divisor;
        $current = $pre_cache['raritan_inletPoleTable'][$index][$x]['inletPoleVoltage'] / $divisor;
        discover_sensor(null, 'voltage', $device, $oid, $tmp_index, 'raritan', $descr, $divisor, 1, $low_limit, $low_limit, $warn_limit, $high_limit, $current);
    }
}
