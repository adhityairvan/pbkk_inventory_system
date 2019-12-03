<?php
namespace App\Models;

use Carbon\Carbon;

class Transactions extends \Phalcon\Mvc\Model
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
    public $total_harga;

    /**
     *
     * @var integer
     */
    public $created_by;

    /**
     *
     * @var string
     */
    protected $created_at;

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
        $this->setSource("transactions");
        $this->hasMany('id', TransactionsItem::class, 'transactions_id', ['alias' => 'Items']);
        $this->belongsTo('created_by', Users::class, 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'transactions';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Transactions[]|Transactions|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Transactions|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getCreatedAt(){
        return new Carbon($this->created_at);
    }

    public function beforeCreate() {
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function beforeUpdate() {
        $this->updated_at = Carbon::now();
    }

}
