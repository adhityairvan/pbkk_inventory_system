<?php


namespace App\Forms;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Alnum;
use Phalcon\Validation\Validator\Digit;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\PresenceOf;
class ItemForm extends Form
{
    public function initialize() {
        $namaBarang = new Text('nama_barang',[
            'placeholder' => 'enter item name',
            'class' => 'form-control',
        ]);
        $namaBarang->addValidator(new PresenceOf());
        $hargaBarang = new Numeric('harga_barang',[
            'placeholder' => 'enter item price',
            'class' => 'form-control',
        ]);
        $hargaBarang->addValidator(new Digit());
        $stock = new Numeric('stock',[
            'placeholder' => 'enter starting item stock',
            'class' => 'form-control',
        ]);
        $gambar = new File('image',[
            'placeholder' => 'enter item name',
            'class' => 'file',
            'aria-describedby' => 'gambarBarangHelp'
        ]);
        $gambar->addValidator(new \Phalcon\Validation\Validator\File([
            'allowEmpty' => true
        ]));
        $tipeBarang = new Select('tipe_barang', [
            'minuman' => 'Minuman',
            'makanan' => 'Makanan',
            'snack' => 'Snack',
            'rokok' => 'Rokok'
        ],[
            'class' => 'form-control',
            'useEmpty'   => true,
            'emptyText'  => 'Select one...',
            'emptyValue' => '',
        ]);
        $tipeBarang->addValidator(new PresenceOf());
        $tipeBarang->addValidator(new InclusionIn([
            'domain' => ['minuman', 'makanan', 'snack', 'rokok']
        ]));

        $this->add($namaBarang);
        $this->add($hargaBarang);
        $this->add($stock);
        $this->add($gambar);
        $this->add($tipeBarang);

    }
}