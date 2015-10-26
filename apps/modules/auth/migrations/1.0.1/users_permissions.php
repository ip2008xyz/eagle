<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UsersPermissionsMigration_101
 */
class UsersPermissionsMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('users_permissions', array(
                'columns' => array(
                    new Column(
                        'user_id',
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
                            'after' => 'user_id'
                        )
                    ),
                    new Column(
                        'user_permission_type',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => '0',
                            'notNull' => true,
                            'size' => 4,
                            'after' => 'permission_id'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('user_id', 'permission_id')),
                    new Index('user_permission_type', array('user_permission_type')),
                    new Index('fk_permissions_u_p_permission_id', array('permission_id'))
                ),
                'references' => array(
                    new Reference(
                        'fk_permissions_u_p_permission_id',
                        array(
                            'referencedSchema' => 'eagle',
                            'referencedTable' => 'permissions',
                            'columns' => array('permission_id'),
                            'referencedColumns' => array('permission_id')
                        )
                    ),
                    new Reference(
                        'fk_users_u_p_user_id',
                        array(
                            'referencedSchema' => 'eagle',
                            'referencedTable' => 'users',
                            'columns' => array('user_id'),
                            'referencedColumns' => array('user_id')
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

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        self::$_connection->dropTable('users_permissions');

    }

}
