@push('scripts')
<script type="text/javascript" src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            increaseArea: '20%' // optional
        });

        $('#super_admin').on('ifChecked', function(event){
            $('#event_creator').iCheck('uncheck');
        });

        $('#event_creator').on('ifChecked', function(event){
            $('#super_admin').iCheck('uncheck');
        });
    });
</script>
@endpush