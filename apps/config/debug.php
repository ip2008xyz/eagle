<?php
function isme()
{
    return true;
}

function dump()
{

    if (!isme()) {
        return true;
    }

    $tmp = debug_backtrace();

    echo '<div style="background-color:#F4F3F1">';

    $to_debug = $tmp[0];

    if (!isset($to_debug['file'])) {
        //this is from prdie
        $to_debug = $tmp[2];
    }
    echo '<div><b>File:</b> ' . $to_debug['file'] . ':  ' . $to_debug['line'] . '</div>';

    echo '<pre style="background-color: #FDF5CE; padding: 5px;">';
    foreach (func_get_args() as $v) {
        var_dump($v);
    }
    echo '</pre>';
    echo '</div>';
    ob_flush();
}

function prdie()
{
    forward_static_call_array('dump', func_get_args());
    exit();
}

function app_shutdown()
{
    $error = error_get_last();
    if ($error['type'] === E_ERROR) {
        // fatal error has occured
    }
}

function app_error_handler($errno, $errstr, $errfile, $errline)
{

    switch ($errno) {
        case E_USER_ERROR:
            echo "<b>ERROR</b> [$errno] $errstr<br />\n";
            echo "  Fatal error on line $errline in file $errfile";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
            exit(1);
            break;

        case E_USER_WARNING:
            echo "<b>WARNING</b> [$errno] $errstr line $errline in file $errfile " . PHP_EOL;
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")" . PHP_EOL;
            break;

        case E_USER_NOTICE:
            echo "<b>NOTICE</b> [$errno] $errstr line $errline in file $errfile " . PHP_EOL;
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")" . PHP_EOL;
            break;
        case 10:
            echo "<b>Uncaught Exception</b> [$errno] $errstr line $errline in file $errfile " . PHP_EOL;
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")" . PHP_EOL;
            break;

        default:
            echo "Unknown error type: [$errno] $errstr line $errline in file $errfile " . PHP_EOL;
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")" . PHP_EOL;
            break;
    }


    return true;
}

function app_exception_handler($exception)
{
    app_error_handler(10, $exception->getMessage(), $exception->getFile(), $exception->getLine());
}

