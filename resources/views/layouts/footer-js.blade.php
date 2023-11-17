<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/feather.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/datatables-1.13.6/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/datatables-1.13.6/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/plugins/izitoast/js/iziToast.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/plugins/tinymce/tinymce2.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- ///////////////////////sortable/////////////////////////////////////////// -->
<script src="{{asset('assets/plugins/jquery-ui/ui/jquery-sortable.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/ui/Sortable.min.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/functions.js')}}"></script>
<script type="text/javascript">
  $(document).on('click', '.verify-prompt', function(e) {
              e.preventDefault();
              Swal.fire({
                title: $(this).data('prompt-msg'),
                showDenyButton: true,
                confirmButtonText: 'Yes',
                icon: 'question',
              }).then((result) => {
                if(result.isConfirmed){
                window.location.href=$(this).data('href');     
                }
            });

  });


</script>


@yield('js')