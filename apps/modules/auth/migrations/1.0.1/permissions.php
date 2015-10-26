<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class PermissionsMigration_101
 */
class PermissionsMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('permissions', array(
                'columns' => array(
                    new Column(
                        'permission_id',
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
                        'permission_name',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'permission_id'
                        )
                    ),
                    new Column(
                        'permission_mca',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'permission_name'
                        )
                    ),
                    new Column(
                        'permission_active',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => '0',
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 3,
                            'after' => 'permission_mca'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('permission_id')),
                    new Index('permission_data', array('permission_mca')),
                    new Index('permission_active', array('permission_active'))
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '5',
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
        self::$_connection->insert("permissions", array(1, "User can Login / Logout", 'auth_index_*', 1));
        self::$_connection->insert("permissions", array(2, 'Can view Default module, index controller', 'index_index_*', 1));
        self::$_connection->insert("permissions", array(3, 'God Permission', '*_*_*', 1));
        self::$_connection->insert("permissions", array(4, 'Install modules', 'core_install_*', 1));

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        self::$_connection->dropTable('permissions');
    }

}

