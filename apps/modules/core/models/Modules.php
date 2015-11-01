<?php
namespace Eagle\Core\Models;

use Eagle\Core\Services\Debug;
use Phalcon\DI;

class Modules
{
    protected $_modules = array();
    protected $_modules_path = MODULES_PATH;
    /**
     * TODO put every paths into config variables
     */
    protected $_cache_dir = CACHE_DIR;

    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        static::$instance->_cache_dir = CACHE_DIR . '/config';

        return static::$instance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {

    }

    public function updateModules($input)
    {
        $to_install = array();
        $to_uninstall = array();

        foreach ($input as $module_key => $v) {

            //module does not exist
            if (!isset($this->_modules[$module_key])) {
                continue;
            }

            if ($this->_modules[$module_key]['priority'] < 100) {
                //this is a core module, do not uninstall
                continue;
            }

            $v = is_null($v) ? 0 : 1;


            if ($v === 0 && $this->_modules[$module_key]['installed'] === true) {
                $to_uninstall[$module_key] = $module_key;
            } elseif ($v === 1 && $this->_modules[$module_key]['installed'] === false) {
                $to_install[$module_key] = $module_key;
            }

        }

        $this->installModules($to_uninstall, 'uninstall');
        $this->installModules($to_install);

        Debug::success('Done', true);

    }


    public function initialize($modules_path = null)
    {
        if (!is_null($modules_path)) {
            $this->_modules_path = $modules_path;
        }

        if (!is_dir($this->_modules_path)) {
            throw new \Exception("Folder does not exist");
        }
    }


    public function getAll($force = false)
    {

        if (empty($this->_modules || $force === true)) {
            $this->_modules = $this->scanModulesDir();
            $installed_modules = (array) \Phalcon\DI::getDefault()->get('modules');


            foreach ($this->_modules as $module_key => $module) {
                $this->_modules[$module_key]['installed'] = false;

                if (isset($installed_modules[$module_key])) {
                    $this->_modules[$module_key]['installed'] = true;
                }
            }
        }
        return $this->_modules;
    }

    protected function scanModulesDir()
    {
        $modules = array();

        $files = scandir($this->_modules_path);
        foreach ($files as $k => $v) {
            if ($v === '.' || $v === '..') {
                continue;
            }
            $file = $this->_modules_path . '/' . $v . '/config/info.php';

            if (is_file($file)) {
                $modules[$v] = require_once $this->_modules_path . '/' . $v . '/config/info.php';
            }

        }

        return $modules;

    }

    protected function installModules($modules, $action = 'install')
    {

        /**
         * TODO update the modules to the latest version
         */
        Debug::info("Start to {$action} " . count($modules) . ' modules', true);
        //phalcon migration --action=run --config="\config\miration.php" --migrations="\apps\auth\migrations"
        //phalcon migration --action=run --config="\config\migration.php" --migrations="\apps\auth\migrations --version=1.0.0"
        //phalcon migration --action=run --config="\config\migration.php" --migrations="\apps\auth\migrations --version=1.0.2"
        //phalcon migration --action=generate --config="\apps\config\migration.php" --migrations="\apps\modules\menus\migrations" --table=menus

        $modules_installed = include APPS_PATH . '/config/modules.php';

        foreach ($modules as $module_key) {

            Debug::info(ucfirst($action) . " module: {$module_key}", true);

            //add the module to installed modules
            if($action === 'install') {
                $modules_installed[$module_key] = $this->_modules[$module_key];
                unset($modules_installed[$module_key]['installed']);
                unset($modules_installed[$module_key]['key']);
            }

            //first we run the migrations
            if (is_dir(MODULES_PATH . '/' . $module_key . '/migrations')) {

                $local_migration_file = APP_PATH . '/.phalcon/' . $module_key . '-migration-version';

                if(!is_file($local_migration_file)) {
                    file_put_contents($local_migration_file, '0');
                }

                copy($local_migration_file, APP_PATH . '/.phalcon/migration-version');

                $command = 'cd ' . APP_PATH . ' & phalcon migration'
                    . ' --action=run'
                    . ' --config="/apps/config/migrations/' . strtolower(APPLICATION_ENV) . '.php"'
                    . ' --migrations="/apps/modules/' . $module_key . '/migrations/"';

                if($action === 'uninstall') {
                    $command .= ' --version=1.0.0';
                    Debug::info("Run migration to 1.0.0 for: " . $module_key);
                } else {
                    Debug::info("Run migration to latest for: " . $module_key);
                }
                $response = '';
                $var = null;
                Debug::warning($command);

                exec($command, $response, $var);

                Debug::status($response);
                Debug::status($var);

                copy(APP_PATH . '/.phalcon/migration-version', $local_migration_file);

                /**
                 * TODO display the answer in log mode
                 */
                //prdie($commnad, $answer,  $response);
            }

            if (is_file(MODULES_PATH . '/' . $module_key . '/config/install.php')) {

                include_once MODULES_PATH . '/' . $module_key . '/config/install.php';
                $method_name = "{$module_key}_{$action}";

                if (function_exists($method_name)) {

                    call_user_func($method_name, DI::getDefault());
                    Debug::info("Run {$method_name}()");
                }

            }

            //remove the module from installed modules
            if($action === 'uninstall') {
                unset($modules_installed[$module_key]);
            }

            Debug::success("Module {$action}ed: {$module_key}", true);
        }


        $this->writeModulesToFile($modules, $modules_installed);

    }


    public function sortByPriority($a, $b) {
        if ($a['priority'] == $b['priority']) {
            return 0;
        }
        return ($a['priority'] < $b['priority']) ? -1 : 1;
    }


    protected function writeModulesToFile($modules, $modules_installed, $type = 'install') {

        if (count($modules) > 0) {

            foreach($modules_installed as $k => $v) {
                $modules_installed[$k]['priority'] = (int) $v['priority'];
            }

            uasort($modules_installed, array('Eagle\Core\Models\Modules','sortByPriority'));

            copy(APPS_PATH . '/config/modules.php', $this->_cache_dir . '/' .date('Ymd_His_') . substr(microtime(true), -4). ".{$type}.modules.log");

            $this->writeArray($modules_installed, APPS_PATH . '/config/modules.php');

            Debug::info("Overwrite modules.php");

        }
    }

    protected function writeArray($arr, $file = null, $space = 4)
    {
        $to_write = array();


        if (!is_null($file)) {

            $to_write[] = '<?php ';
            $to_write[] = 'return [ ';
        }

        foreach ($arr as $key => $v) {
            if (is_array($v)) {
                $to_write[] = str_pad('', $space, ' ', STR_PAD_LEFT) . '\'' . $key . '\' => [';
                $to_write[] = $this->writeArray($v, null, $space + 4);
                $to_write[] = str_pad('', $space, ' ', STR_PAD_LEFT) . '],';
            } else {
                $v_value = $v;
                if(!is_numeric($v_value)) {
                    $v_value = "'{$v_value}'";
                }
                $to_write[] = str_pad('', $space, ' ', STR_PAD_LEFT) . '\'' . $key . "' => $v_value,";
            }
        }
        if (!is_null($file)) {

            $to_write[] = ']; ';
            file_put_contents($file, implode("\n", $to_write));
            //prdie(implode("\n", $to_write));
        } else {

            return implode("\n", $to_write);
        }
    }

}
