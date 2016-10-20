@extends('template')

@push('css')
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
            </div>
            @include('event.include.breadcrumb', ['title' => 'Add Event'])
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Event</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @include('include.error')

                        <form data-parsley-validate class="form-horizontal form-label-left"
                              action="{{ url('events') }}" method="POST" enctype="multipart/form-data">
                            @include('event.include.form', ['edit' => false])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#date').daterangepicker({
                locale: {
                    format: 'YYYY/MM/DD'
                },
                startDate: moment(),
                singleDatePicker: true,
                autoUpdateInput: false
            }, function(start, end, label) {
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