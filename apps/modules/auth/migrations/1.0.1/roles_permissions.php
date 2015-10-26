<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class RolesPermissionsMigration_100
 */
class RolesPermissionsMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('roles_permissions', array(
                'columns' => array(
                    new Column(
                        'role_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'first' => true
                        )
                    ),
                    new Column(
                        'permission_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'role_id'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('role_id', 'permission_id')),
                    new Index('fk_permissions_r_p_permission_id', array('permission_id'))
                ),
                'references' => array(
                    new Reference(
                        'fk_permissions_r_p_permission_id',
                        array(
                            'referencedSchema' => 'eagle',
                            'referencedTable' => 'permissions',
                            'columns' => array('permission_id'),
                            'referencedColumns' => array('permission_id')
                        )
                    ),
                    new Reference(
                        'fk_roles_r_p_role_id',
                        array(
                            'referencedSchema' => 'eagle',
                            'referencedTable' => 'roles',
                            'columns' => array('role_id'),
                            'referencedColumns' => array('role_id')
                        )
                    )
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '',
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
        self::$_connection->insert("roles_permissions",array(0, 2));
        self::$_connection->insert("roles_permissions",array(1, 1));
        self::$_connection->insert("roles_permissions",array(1, 2));
        self::$_connection->insert("roles_permissions",array(1, 3));
        self::$_connection->insert("roles_permissions",array(1, 4));
        self::$_connection->insert("roles_permissions",array(2, 1));
        self::$_connection->insert("roles_permissions",array(2, 2));
        self::$_connection->insert("roles_permissions",array(2, 4));


    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        self::$_connection->dropTable('roles_permissions');
    }

}
