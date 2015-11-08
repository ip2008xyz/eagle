<?php
namespace Eagle\Core\Models;



class Config
{

    //protected static $_path = ;

    public static function writeDefine($name, $value) {
        $name = strtoupper(trim($name));
        $value = strtolower(trim($value));

        $response = file(DATA_DIR . '/config/definitions.inc');

        $response_text = implode(' ', $response);

        if(stripos($response_text, $name) === FALSE) {
            $response [] = "define('{$name}', '{$value}');";
        } else {
            foreach($response as $k => $v) {
                if(stripos($v, $name) !== FALSE) {
                    $response[$k] = "define('{$name}', '{$value}');";
                    break;
                }
            }


        }

        foreach($response as $k => $v) {

            if(trim($v) == '') {
                unset($response[$k]);

            } else {
                $response[$k] = trim($v);
            }

        }

        file_put_contents(DATA_DIR . '/config/definitions.inc', implode("\n\n", $response));

    }

}
