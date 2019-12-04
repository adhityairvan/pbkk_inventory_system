{% extends 'template/base.volt' %}
{% block title %}Item Category{% endblock %}
{% block css %}
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
{% endblock %}
{% block title_body %}Category List{% endblock %}
{% block body %}
<div class="row">
    <div class="col-12">
        <h5>Create new Category</h5>
        <form method="POST" action="/kategori/create">
            {{ partial('partials/flash') }}
            <div class="form-group col-6">
                <label for="namaKategori">Nama Kategori</label>
                <input type="text" class="form-control" name="nama_kategori" id="namaKategori">
            </div>
            <div class="form-group col-6">
                <button type="submit" class="btn btn-primary">Submit</button>

            </div>
        </form>
    </div>
    <div class="col-12">
        <h5>Category List</h5>
        <div class="table-responsive">
            <table class="table table-borderless" id="kategoriTable">
                <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Barang</th>
                    <th>Manage</th>
                </tr>
                </thead>
                <tbody>
                {% for kategori in kategories %}
                <tr>
                    <td>{{ kategori.id }}</td>
                    <td>{{ kategori.nama_kategori }}</td>
                    <td>{{ kategori.Items |length }}</td>
                    <td>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal" data-id="{{ user.id }}">Delete</button>
                    </td>
                </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete category?
                <form method="post" action="/kategori/delete" id="deleteForm">
                    <input type="hidden" id="deleteInput" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" form="deleteForm">Delete</button>
            </div>
        </div>
    </div>
</div>
{% endblock %}

{% block script %}
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kategoriTable').DataTable({
                bInfo: false,
                paging: false,
                searching: false,
                columnDefs: [
                    { width: '60%', targets: 1 },
                    { width: '15%', targets: 2 }
                ],
            });
        });
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            const id = button.data('id');
            const modal = $(this);
            modal.find('#deleteInput').val(id);
        })
    </script>
{% endblock %}