<?php

$graphs = [
    'fail2ban_banned' => 'Total Banned',
];

foreach ($graphs as $key => $text) {
    $graph_type = $key;
    $graph_array['height'] = '100';
    $graph_array['width'] = '215';
    $graph_array['to'] = \App\Facades\LibrenmsConfig::get('time.now');
    $graph_array['id'] = $app->app_id;
    $graph_array['type'] = 'application_' . $key;

    echo '<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">' . $text . '</h3>
    </div>
    <div class="panel-body">
    <div class="row">';
    include 'includes/html/print-graphrow.inc.php';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

$jails = $app->data['jails'] ?? [];
sort($jails);
foreach ($jails as $jail) {
    $jail = htmlspecialchars($jail);
    $graph_type = 'fail2ban_jail';
    $graph_array['height'] = '100';
    $graph_array['width'] = '215';
    $graph_array['to'] = \App\Facades\LibrenmsConfig::get('time.now');
    $graph_array['id'] = $app->app_id;
    $graph_array['type'] = 'application_fail2ban_jail';
    $graph_array['jail'] = $jail;

    echo '<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Jail: ' . $jail . '</h3>
    </div>
    <div class="panel-body">
    <div class="row">';
    include 'includes/html/print-graphrow.inc.php';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
