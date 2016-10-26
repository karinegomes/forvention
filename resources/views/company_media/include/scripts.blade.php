@push('scripts')
<script>
    $(document).ready(function() {
        $('#choose-file').on('click', function() {
            $('#file').trigger('click');
        });

        $('#file').on('change', function(event) {
            readURL(this, event);
        });
    });

    function readURL(input, event) {

        if (input.files && input.files[0]) {
            var selectedFile = event.target.files[0];
            var extension = selectedFile.name.substr(selectedFile.name.lastIndexOf('.'));
            var fileName = selectedFile.name.replace(extension, '');

            $('#file_name').val(fileName);
        }

    }
</script>
@endpush