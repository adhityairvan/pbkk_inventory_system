<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ItemsMigration_100
 */
class ItemsMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('items', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 11,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'nama_barang',[
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                        ]
                    ),
                    new Column(
                        'harga_barang',[
                            'type' => Column::TYPE_INTEGER,
                            'default' => 0,
                            'size' => 11,
                            'unsigned' => true,
                        ]
                    ),
                    new Column(
                        'stock',[
                            'type' => Column::TYPE_INTEGER,
                            'default' => 1,
                            'unsigned' => true,
                        ]
                    ),
                    new Column(
                        'image',[
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => false,
                        ],
                    ),
                    new Column('created_at', [
                        'type' => Column::TYPE_TIMESTAMP,
                    ]),
                    new Column('updated_at', [
                        'type' => Column::TYPE_TIMESTAMP,
                    ])
                ],
                'indexes' => [
                    new Index('PRIMARY', ['id'], 'PRIMARY')
                ],
                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '1',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'latin1_swedish_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        $this->morph();
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        $this->morphTable('items', [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '1',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'latin1_swedish_ci'
            ]
            ]
        );
    }

}
