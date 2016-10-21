@extends('template')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
            </div>
            @include('event.include.breadcrumb')
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>View Events</h2>

                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="{{ url('events/create') }}"><i class="fa fa-plus"></i> Add Event</a></li>
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

                        <table id="events-table" class="table table-bordered table-striped dt-responsive nowrap hover"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Visitors</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('events/' . $event->id . '/users') }}" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View Users</a>
                                        <a href="{{ url('events/' . $event->id . '/add-user') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add User</a>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{ url('events/' . $event->id . '/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                            <span class="btn btn-danger btn-xs delete-span" data-toggle="modal" data-target="#delete-modal-{{ $event->id }}"><i class="fa fa-trash-o"></i> Delete </span>
                                        </div>
                                        <div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="delete-modal-{{ $event->id }}">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel2">Delete confirmation</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>Delete {{ $event->title }}</h4>
                                                        <p>Are you sure you want to delete the event {{ $event->title }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <form action="{{ url('events/' . $event->id) }}" method="POST" class="delete-form">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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
        $('#events-table').DataTable();
    });
</script>
@endpush