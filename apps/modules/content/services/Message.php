<?php
namespace Eagle\Core\Services;

class Message {

    private static $messages = array();
    private static $messages_ajax = array();

    protected static $count = 1;
    protected static $count_ajax = 1;

    public static function ajax($link, $element = NULL, $with_preloader = 0) {
        $elem = !empty($element) ? "jQuery('{$element}')" : "null";
        echo  		"<script type='text/javascript'>"
            .	"jQuery(document).ready(function() { "
            .	"ajax_get('{$link}', {$elem}, {$with_preloader})"
            .	"});"
            .   "</script>";

    }

    public static function echo_script($script, $on_ready = true) {
        echo "<script type='text/javascript'>";
        if ($on_ready) echo "jQuery(document).ready(function() { ";
        echo $script;
        if ($on_ready) echo "});";
        echo "</script>";
    }


    public static function ajax_echo($script) {
        $key = (string) microtime(TRUE) . '.' . (self::$count_ajax++);
        self::$messages_ajax[$key] = '<script type="text/javascript">jQuery(document).ready(function() {' . $script . '});</script>';
    }

    public static function write_ajax($link, $element) {
        $key = (string) microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['ajaxcall']['text'] 		= 	$link;
        self::$messages[$key]['ajaxcall']['translate'] 	= 	$element;
    }

    public static function warning($message, $translate = NULL) {
        $key = (string) microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['warning']['text'] 		= 	$message;
        self::$messages[$key]['warning']['translate'] 	= 	$translate;
    }

    public static function status($message, $translate = NULL) {
        $key = (string) microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['status']['text'] 		= 	$message;
        self::$messages[$key]['status']['translate'] 	= 	$translate;
    }

    public static function success($message, $translate = NULL) {
        $key = (string) microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['success']['text'] 		= 	$message;
        self::$messages[$key]['success']['translate'] 	= 	$translate;

    }

    public static function error($message, $translate = NULL) {
        $key = (string) microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['error']['text'] 		= 	$message;
        self::$messages[$key]['error']['translate'] = 	$translate;
    }


    public static function info($message, $translate = NULL) {
        $key = (string) microtime(TRUE) . '.' . (self::$count++);

        self::$messages[$key]['info']['text'] 		= 	$message;
        self::$messages[$key]['info']['translate'] 	= 	$translate;
    }


    public static function exception($exception, $translate = NULL) {

        if(is_object($exception)) {
            $message = $exception->getMessage();
        }
        else {
            $message = $exception;
        }

        $key = (string) microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['exception']['text'] 			= 	$message;
        self::$messages[$key]['exception']['translate'] 	= 	$translate;

    }

    private static function write_echo($class = "alert-info", $message, $translate = NULL) {

        echo "<div class='alert {$class}'>{$message}</div>";

    }

    public static function write_warning($message, $translate = NULL) {
        self::write_echo("alert-warning", $message, $translate);
    }

    public static function write_status($message, $translate = NULL) {
        self::write_echo("alert", $message, $translate);
    }

    public static function write_info($message, $translate = NULL) {
        self::write_echo("alert-info", $message, $translate);
    }

    public static function write_success($message, $translate = NULL) {
        self::write_echo("alert-success", $message, $translate);
    }

    public static function write_error($message, $translate = NULL) {
        self::write_echo("alert-danger", $message, $translate);
    }

    public static function write_exception($exception, $translate = NULL) {
        if(is_object($exception)) {
            self::write_echo("alert-danger", $exception->getMessage(), $translate);
        } else {
            self::write_echo("alert-danger", $exception, $translate);
        }
    }

    public static function write_label($message, $translate = NULL) {
        self::write_echo(" ", $message, $translate);
    }

    public static function write_ajax_echo() {
        foreach(self::$messages_ajax as $message) {
            echo $message;
        }
    }


    public static function write() {

        foreach(self::$messages as $v) {

            foreach($v as $k => $message) {
                $function = 'write_' . $k;
                self::$function($message['text'], $message['translate']);
            }
        }

    }
}
