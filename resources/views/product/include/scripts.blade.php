@push('scripts')
<script src="{{ asset('vendors/jQuery-Tags-Input/js/jquery.tagsinput.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#choose-image').on('click', function() {
            $('#image').trigger('click');
        });

        $('#image').on('change', function() {
            readURL(this);
        });
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

    $('#tags').tagsInput({
        'width': 'auto'
    });
</script>
@endpush