<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class MenusMigration_101
 */
class MenusMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('menus', array(
                'columns' => array(
                    new Column(
                        'menu_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 10,
                            'first' => true
                        )
                    ),
                    new Column(
                        'menu_group',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'menu_id'
                        )
                    ),
                    new Column(
                        'menu_name',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'menu_group'
                        )
                    ),
                    new Column(
                        'menu_level',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => '0',
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'menu_name'
                        )
                    ),
                    new Column(
                        'menu_order',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => '100',
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'menu_level'
                        )
                    ),
                    new Column(
                        'menu_link',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'menu_order'
                        )
                    ),
                    new Column(
                        'menu_permission',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'menu_link'
                        )
                    ),
                    new Column(
                        'menu_pid',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'size' => 10,
                            'after' => 'menu_permission'
                        )
                    ),
                    new Column(
                        'menu_active',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => '0',
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 3,
                            'after' => 'menu_pid'
                        )
                    ),
                    new Column(
                        'menu_icon',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 255,
                            'after' => 'menu_active'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('menu_id')),
                    new Index('menu_group', array('menu_group')),
                    new Index('menu_level', array('menu_level')),
                    new Index('menu_order', array('menu_order'))
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '10',
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
        self::$_connection->insert("menus", array(1, 'Admin', '(Root)', 1, 0, '#', 'index_index_index', NULL, 1, 'desktop'));

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
