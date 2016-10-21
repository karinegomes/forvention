@extends('template')

@push('css')
    <link href="{{ url('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
            </div>
            @include('event.include.breadcrumb', ['title' => 'Add Company'])
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Company to Event {{ $event->name }}</h2>

                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {!! session('message') !!}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3">
                            <form action="{{ url('events/' . $event->id . '/add-company') }}" method="POST">
                                {{ csrf_field() }}
                                <table id="company-event-table" class="table table-bordered table-striped dt-responsive nowrap hover"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Companies</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td class="text-center">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="company[]" value="{{ $company->id }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $company->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="ln_solid"></div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('events') }}">
                                            <button type="button" class="btn btn-primary">Cancel</button>
                                        </a>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@endsection

@push('scripts')
<script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#company-event-table').DataTable({
            "paging":   false,
            "ordering": false,
            "info":     false,
            "bFilter":   false
        });
    });
</script>
@endpush