<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UsersMigration_101
 */
class UsersMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('users', array(
                'columns' => array(
                    new Column(
                        'user_id',
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
                        'user_name',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'user_id'
                        )
                    ),
                    new Column(
                        'user_email',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'user_name'
                        )
                    ),
                    new Column(
                        'user_password',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'user_email'
                        )
                    ),
                    new Column(
                        'user_active',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => '0',
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 3,
                            'after' => 'user_password'
                        )
                    ),
                    new Column(
                        'user_created',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'user_active'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('user_id')),
                    new Index('user_name', array('user_name')),
                    new Index('user_email', array('user_email')),
                    new Index('user_active', array('user_active'))
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '2',
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
        self::$_connection->insert("users", array(0, 'guest', 'guest', '', 0, 0));
        self::$_connection->insert("users", array(1, 'ionut', 'marcel.toma@endava.com', '$2a$08$JcLm1IONh99AlUCnHfuzZukb82QEvFZoFLTEwSYzJr5gb4MjC5PaS', 1, 0));


    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        self::$_connection->dropTable('users');
    }

}
