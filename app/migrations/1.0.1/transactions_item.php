<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class TransactionsItemMigration_101
 */
class TransactionsItemMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('transactions_item', [
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
                    new Column('items_id',[
                        'type' => Column::TYPE_INTEGER,
                        'size' => 11,
                        'notNull' => true,
                    ]),
                    new Column('jumlah', [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'default' => 1,
                    ]),
                    new Column('total_harga', [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 14,
                    ]),
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

    }

}
