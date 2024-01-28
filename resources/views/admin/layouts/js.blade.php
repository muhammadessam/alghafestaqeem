<!-- plugins:js -->
<script src="/panel/vendors/js/vendor.bundle.base.js"></script>

<script src="/panel/js/off-canvas.js"></script>
<script src="/panel/js/hoverable-collapse.js"></script>

<script src="/panel/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/panel/js/dashboard.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
<script src=" https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src=" https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>


<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tableone').DataTable({
            //   "ordering": false,
            //   "paging": false,
            order: [
                [0, 'desc']
            ]
            , columnDefs: [{
                target: 0
                , visible: false
                , searchable: false
            }]
            , dom: 'Bfrtip'
            , buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        });
    });

</script>

<script>
    $('#Read').click(function() {

        $.get('/admin/makeAsread');

    });

</script>


@yield('scripts')
