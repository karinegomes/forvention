@extends('template')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
            </div>
            @include('event.include.breadcrumb', ['title' => 'View Companies'])
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Event {{ $event->title }} - View Companies</h2>

                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{{ url('events/' . $event->id . '/add-company') }}">
                                    <i class="fa fa-plus"></i> Add Company
                                </a>
                            </li>
                        </ul>

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

                        <table id="company-event-table" cellspacing="0" width="100%"
                               class="table table-bordered table-striped dt-responsive nowrap hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>
                                        <div class="text-center">
                                            <span class="btn btn-danger btn-xs delete-span" data-toggle="modal"
                                                  data-target="#delete-modal-{{ $company->id }}">
                                                <i class="fa fa-trash-o"></i> Delete
                                            </span>
                                        </div>
                                        @include('include.modal', [
                                            'id' => $company->id,
                                            'deleteTitle' => 'Delete ' . $company->name . ' from ' . $event->title,
                                            'deleteMessage' => 'Are you sure you want to remove ' . $company->name . ' from ' . $event->title . '?',
                                            'url' => 'events/' . $event->id . '/company/' . $company->id . '/delete'
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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

<script>
    $(document).ready(function () {
        $('#company-event-table').DataTable();
    });
</script>
@endpush