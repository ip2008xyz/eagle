<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class MenusMigration_100
 */
class MenusMigration_100 extends Migration
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
        self::$_connection->dropTable('menus');


    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

        self::$_connection->dropTable('menus');
    }

}
