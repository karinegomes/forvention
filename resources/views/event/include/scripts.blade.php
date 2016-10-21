@push('scripts')
<script type="text/javascript" src="{{ asset('vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script>
    $(document).ready(function() {

        var edit = '{{ $edit ? 'true' : 'false' }}';

        edit = JSON.parse(edit);

        var optionsDate = {
            locale: {
                format: 'YYYY/MM/DD'
            },
            singleDatePicker: true,
            autoUpdateInput: false
        };

        if(!edit) {
            optionsDate.startDate = moment();
        }

        $('#date').daterangepicker(optionsDate, function(start, end, label) {
            $('#date').val(start.format('YYYY/MM/DD'));
        });

        $('#choose-image').on('click', function() {
            $('#image').trigger('click');
        });

        $('#image').on('change', function() {
            readURL(this);
        });

        var options = {
            minuteStep: 10,
            defaultTime: false
        };

        $('#start').timepicker(options);
        $('#end').timepicker(options);
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush