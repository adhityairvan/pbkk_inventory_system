<?php
namespace App\Models;

use Carbon\Carbon;

class TransactionsItem extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $items_id;

    /**
     *
     * @var integer
     */
    public $transactions_id;

    /**
     *
     * @var integer
     */
    public $jumlah;

    /**
     *
     * @var integer
     */
    public $total_harga;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("pbkk_fp");
        $this->setSource("transactions_item");
        $this->hasOne('items_id', 'Items', 'id');
        $this->belongsTo('transactions_id', 'Transactions', 'id');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'transactions_item';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TransactionsItem[]|TransactionsItem|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TransactionsItem|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function beforeCreate() {
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function beforeUpdate() {
        $this->updated_at = Carbon::now();
    }

}
