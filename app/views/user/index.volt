{% extends 'template/base.volt' %}
{% block css %}
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
{% endblock %}
{% block title %}
Manage User
{% endblock %}
{% block title_body %}
Your Shop's Staff
{% endblock %}
{% block body %}
<div class="row">
    <div class="col-md-12">
        <h5>Create new Staff</h5>
        {{ partial('partials/flash') }}
        <form method="post" action="/user/create">
            <div class="form-group">
                <label for="email">Email Pegawai</label>
                {{ form.render('email') }}
            </div>
            <div class="form-group">
                <label for="password">Password Pegawai</label>
                {{ form.render('password') }}
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <div class="col-md-12">
        <hr>
        <h5>Staff List</h5>
        <div class="table-responsive">
            <table class="table table-borderless" id="userTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Tipe</th>
                    <th>Jumlah Transaksi</th>
                    <th>Manage</th>
                </tr>
                </thead>
                {% for user in users %}
                <tr>
                    <td>{{ user.email }}</td>
                    <td>{% if user.id == 1 %}Pemilik{% else %}Pegawai{% endif %}</td>
                    <td>{{ user.Transactions|length }}</td>
                    <td><button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal" data-id="{{ user.id }}">Delete</button> </td>
                </tr>
                {% endfor %}
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>Email</th>
                    <th>Jumlah Transaksi</th>
                    <th>Manage</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete transaction?
                <form method="post" action="/user/delete" id="deleteForm">
                    <input type="hidden" id="deleteInput" name="user_id">
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
        $('#userTable').DataTable({
            bInfo: false,
            paging: true,
            searching: false,
            ordering: false,
        });
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            const id = button.data('id');
            const modal = $(this);
            modal.find('#deleteUserLabel').text('Delete User '+id);
            modal.find('#deleteInput').val(id);
        })
    });
</script>
{% endblock %}
