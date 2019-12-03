{% extends 'template/base.volt' %}
{% block title %}Transactions{% endblock %}
{% block css %}
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
{% endblock %}
{% block title_body %}View Shop's Transactions{% endblock %}
{% block body %}
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-borderless" id="cartTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Unique ID</th>
                    <th>Total Harga</th>
                    <th>Person In Charge</th>
                    <th>Tanggal Transaksi</th>
                    <th>Manage</th>
                </tr>
                </thead>
                {% for transaction in transactions %}
                <tr>
                    <td>{{ transaction.id }}</td>
                    <td>{{ transaction.total_harga }}</td>
                    <td>{{ transaction.users.email }}</td>
                    <td>{{ transaction.created_at.toDateString() }}</td>
                    <td>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal" data-unique="{{ transaction.id }}">Delete</button>
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#itemModal" data-unique="{{ transaction.id }}">Items</button>
                    </td>
                </tr>
                {% endfor %}
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>Unique ID</th>
                    <th>Total Harga</th>
                    <th>Person In Charge</th>
                    <th>Tanggal Transaksi</th>
                    <th>Manage</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteTransactionModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete transaction?
                <form method="post" action="/transaction/delete" id="deleteForm">
                    <input type="hidden" id="deleteInput" name="unique_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" form="deleteForm">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <thead>
                        <tr>Item Name</tr>
                        <tr>qty</tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        $('#cartTable').DataTable({
            bInfo: false,
            paging: true,
            searching: false,
            ordering: false,
        });
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            const unique = button.data('unique');
            const modal = $(this);
            modal.find('#deleteModalLabel').text('Delete Transaction '+unique);
            modal.find('#deleteInput').val(unique);
        });
    });
</script>
{% endblock %}