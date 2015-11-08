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
                new Index('menu_order', array('menu_order')),
                new Index('fk_menus_m_menu_pid', array('menu_pid'))
            ),
            'references' => array(
                new Reference(
                    'fk_menus_m_menu_pid',
                    array(
                        'referencedSchema' => 'eagle',
                        'referencedTable' => 'menus',
                        'columns' => array('menu_pid'),
                        'referencedColumns' => array('menu_id')
                    )
                ),

            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '10',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_unicode_ci'
            ),
        )
        );

        self::$_connection->query("ALTER TABLE menus DROP FOREIGN KEY fk_menus_m_menu_pid");

        self::$_connection->query("ALTER TABLE `menus` ADD  CONSTRAINT `fk_menus_m_menu_pid` FOREIGN KEY (`menu_pid`) REFERENCES `menus`(`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;");

        self::$_connection->insert("menus", array(1, 'Admin', '(Root)', 1, 0, '#', 'index_index_index', NULL, 1, 'desktop'));
        self::$_connection->insert("menus", array(2, 'Admin', 'Install', 2, 0, '/core/install', '*_*_*', 1, 1, 'wrench'));
        self::$_connection->insert("menus", array(3, 'Admin', 'Menus', 2, 1, '/menus', 'menus_*_*', 1, 1, 'cog'));
        self::$_connection->insert("menus", array(4, 'Admin', 'Roles', 2, 2, '/auth/roles', 'auth_*_*', 1, 1, 'users'));
        self::$_connection->insert("menus", array(5, 'Front', 'Home', 1, 0, '/', 'index_*_*', NULL, 1, 'home'));
        self::$_connection->insert("menus", array(6, 'Admin', 'Exit', 0, 3, '/auth/index/exit', 'auth_index_exit', 1, 1, 'sign-out'));
        self::$_connection->insert("menus", array(7, 'Front', 'Auth', 1, 0, '/auth', 'auth_index_index', 5, 1, 'sign-in'));
        self::$_connection->insert("menus", array(8, 'Front', 'Contact', 1, 2, '/contact', 'index_index_*', 5, 1, 'envelope'));
        self::$_connection->insert("menus", array(9, 'Front', 'Install', 2, 1, '/core/install', 'core_install_*', 5, 1, 'wrench'));

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
