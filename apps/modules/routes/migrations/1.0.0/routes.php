<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class RoutesMigration_100 extends Migration
{

    public function up()
    {
        self::$_connection->dropTable('routes');
    }
    public function down() {
        self::$_connection->dropTable('routes');
    }
}
