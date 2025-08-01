<?php

$name = 'hv-monitor';
$unit_text = 'Blocks/Second';
$colours = 'psychedelic';
$dostack = 0;
$printtotal = 0;
$addarea = 0;
$transparency = 15;

if (isset($vars['vm'])) {
    $rrd_filename = Rrd::name($device['hostname'], ['app', $name, $app->app_id, 'vm', $vars['vm']]);
} else {
    $rrd_filename = Rrd::name($device['hostname'], ['app', $name, $app->app_id]);
}

$rrd_list = [
    [
        'filename' => $rrd_filename,
        'descr' => 'Read',
        'ds' => 'inblk',
    ],
    [
        'filename' => $rrd_filename,
        'descr' => 'Write',
        'ds' => 'oublk',
        'invert' => true,
    ],
];

require 'includes/html/graphs/generic_multi_line.inc.php';
