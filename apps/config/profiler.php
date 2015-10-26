<?php

use Eagle\Core\Services\Debug;

function profile_mysql_nice_format($query)
{
    /**
     * TODO must improve this function, c'mon run the replace every time
     */
    $mysql_words = array('SELECT ', ' WHERE ', ' AND ', ' IF', 'IF(', 'COUNT', 'FROM ', 'DATABASE()', 'DESCRIBE', ' IN ');

    $mysql_nice = array();

    foreach ($mysql_words as $v) {
        $mysql_nice[] = '<span style="color:#3769A0;">' . $v . '</span>';
    }

    return str_replace($mysql_words, $mysql_nice, $query);
}


try {

    Debug::write();

    echo '<div style="background-color:#1d1f21; color: #FFFFFF; font-size:12px; padding: 10px; font-family: \'Consolas\', \'Lucida Console\', monospace">';


    $mysql_time = 0;
    if (isset($application) && $application->di->get('profiler')) {

        if (!is_null($application->di->get('profiler')->getProfiles())) {
            foreach ($application->di->get('profiler')->getProfiles() as $v) {
                $mysql_time += $v->getTotalElapsedSeconds();
                Debug::write_info(profile_mysql_nice_format($v->getSqlStatement()), number_format($v->getTotalElapsedSeconds(), 4));

            }

        }
    }


    Debug::write_warning(number_format($mysql_time, 4, '.', '') . 's', "MYSQL");

    Debug::write_error(number_format(microtime(true) - START_TIME, 4, '.', '') . 's', 'TIME');
    Debug::write_success($_POST, 'POST');
    Debug::write_success($_GET, 'GET');
    Debug::write_success($_SESSION, 'SESSION');
    Debug::write_success($_COOKIE, 'COOKIE');

    register_shutdown_function('app_shutdown');
    set_error_handler('app_error_handler');
    set_exception_handler('app_exception_handler');

    /*$included_files = get_included_files();

    Debug::write_success(count($included_files), "FILES");
    $i = 0;
    foreach ($included_files as $filename) {
        $i++;
        Debug::write_info($filename, $i);

    }/**/

    echo '<div>';

} catch (Exception $e) {
    dump($e);
    echo $e->getMessage();
}