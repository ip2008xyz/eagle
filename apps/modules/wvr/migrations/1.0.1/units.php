<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UnitsMigration_101
 */
class UnitsMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('units', array(
                'columns' => array(
                    new Column(
                        'unit_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        )
                    ),
                    new Column(
                        'unit_title',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'unit_id'
                        )
                    ),
                    new Column(
                        'unit_description',
                        array(
                            'type' => Column::TYPE_TEXT,
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'unit_title'
                        )
                    ),
                    new Column(
                        'unit_company_id',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'unit_description'
                        )
                    ),
                    new Column(
                        'unit_property_id',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'unit_company_id'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('unit_id')),
                    new Index('unit_property_id', array('unit_property_id'))
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '1',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_unicode_ci'
                ),
            )
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        self::$_connection->insert("permissions", array(NULL, 'Admin over WVR units', 'wvr_units_*', 1));

        $permission_id = self::$_connection->lastInsertId();

        self::$_connection->insert("roles_permissions",array(1, $permission_id)); //add role to god

        self::$_connection->insert("menus", array(null, 'Admin', 'Units', 2, 1, '/wvr/units', 'wvr_units_*', 1, 1, 'wrench'));
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

        //self::$_connection->insert("permissions", array(NULL, 'Admin over WVR units', 'wvr_units_*', 1));
        self::$_connection->delete("permissions", 'permission_mca = "wvr_units_*"'); // the delete will propagate
        self::$_connection->delete("menus", 'menu_link = "/wvr/units"'); // the delete will propagate

        self::$_connection->dropTable('units');
    }

}
