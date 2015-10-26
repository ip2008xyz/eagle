<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class PermissionsMigration_100
 */
class PermissionsMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {

    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        self::$_connection->dropTable('permissions');

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        prdie("here");
        self::$_connection->dropTable('permissions');
    }

}

