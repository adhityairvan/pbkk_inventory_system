<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top" src="/<?= (empty($image) ? ('') : ($image)) ?>" alt=""></a>
        <div class="card-body">
            <h4 class="card-title">
                <?= (empty($itemName) ? ('EMPTY ITEM') : ($itemName)) ?>
            </h4>
            <h5>Stok : <b><?= (empty($stok) ? ('0') : ($stok)) ?></b></h5>
            <h5>Harga : Rp <b><?= (empty($harga) ? ('0') : ($harga)) ?></b></h5>
        </div>
        <div class="card-body">
            <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#stokModal" data-id="<?= (empty($id) ? ('1') : ($id)) ?>" data-stok="<?= (empty($stok) ? ('0') : ($stok)) ?>">Edit Stok</button>
            <a class="btn btn-outline-warning btn-block" href="/item/edit/<?= (empty($id) ? ('1') : ($id)) ?>">Edit Item</a>
            <a class="btn btn-outline-danger btn-block" href="/item/delete/<?= (empty($id) ? ('1') : ($id)) ?>">Delete Item</a>
        </div>
    </div>
</div>
