<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class RoutesMigration_101 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'routes',
            array(
            'columns' => array(
                new Column(
                    'route_id',
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
                    'route_name',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'route_id'
                    )
                ),
                new Column(
                    'route_namespace',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'route_name'
                    )
                ),
                new Column(
                    'route_module',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'route_namespace'
                    )
                ),
                new Column(
                    'route_controller',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'route_module'
                    )
                ),
                new Column(
                    'route_action',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'route_controller'
                    )
                ),
                new Column(
                    'route_params',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 255,
                        'after' => 'route_action'
                    )
                ),
                new Column(
                    'route_active',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 3,
                        'after' => 'route_params'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('route_id')),
                new Index('route_name_2', array('route_name')),
                new Index('route_name', array('route_name')),
                new Index('route_active', array('route_active'))
            ),
            'options' => array(
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '3',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_unicode_ci'
            )
        )
        );

        self::$_connection->insert("routes", array(null, 'login', '\Eagle\Auth\Controllers', 'auth', 'index', 'index', null, 1));
        self::$_connection->insert("routes", array(null, 'exit', '\Eagle\Auth\Controllers', 'auth', 'index', 'exit', null, 1));

    }

    public function down() {
        self::$_connection->dropTable('routes');
    }
}
