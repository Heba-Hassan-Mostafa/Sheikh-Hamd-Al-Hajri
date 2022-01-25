
  

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="{{ asset('js/app.js') }}"></script>


{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> --}}

{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> --}}

<script src="{{ asset('adminlte/plugins/select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminlte/plugins/toggle/mdb.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('adminlte/plugins/datatable2/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatable2/js/dataTables.rowReorder.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatable2/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatable2/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatable2/js/dataTables.buttons.js') }}"></script>
<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>

{{-- file manager for ckeditor --}}
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/js/demo.js') }}"></script>
<script src="{{ asset('adminlte/js/myedit.js')}}"></script>
<script>
  $(document).ready(function() {
    var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );
</script>


@stack('js')
@stack('css')
@stack('scripts')
@stack('select')
@stack('ckeditor')

@livewireScripts
@stack('livescript')

</body>
</html>


