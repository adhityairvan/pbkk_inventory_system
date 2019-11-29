{% extends 'template/base.volt' %}
{% block title %}Add New Shop's Item{% endblock %}
{% block title_body %}Add new Item form{% endblock %}
{% block body %}
    <div class="row">
        <div class="col-md-12">
            {{ flashSession.output() }}
            <form method="post" action="{{ url('item/new') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    {{ form.render('nama_barang') }}
                </div>
                <div class="form-group">
                    <label for="harga_barang">Harga Barang</label>
                    {{ form.render('harga_barang') }}
                </div>
                <div class="form-group">
                    <label for="stock">Stok Barang</label>
                    {{ form.render('stock') }}
                </div>
                <div class="form-group">
                    <label for="image">Gambar Barang</label>
                    {{ form.render('image') }}
                    <small id="imageHelp" class="form-text text-muted">Only Upload JPG|PNG. with size smaller than 15mb</small>
                </div>
                <div class="form-group">
                    <label for="tipe_barang">Tipe Barang</label>
                    {{ form.render('tipe_barang') }}
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>
{% endblock %}