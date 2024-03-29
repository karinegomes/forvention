@extends('template')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Companies</h3>
            </div>
            @include('company.include.breadcrumb')
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>View Companies</h2>

                        @if(Auth::user()->hasPermission('MANAGE_COMPANIES'))
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a href="{{ url('companies/create') }}"><i class="fa fa-plus"></i> Add Company</a></li>
                            </ul>
                        @endif

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

                        <table id="companies-table" class="table table-bordered table-striped dt-responsive nowrap hover"
                               cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Media</th>
                                    <th>Products</th>
                                    <th>Users</th>
                                    <th>Events</th>
                                    @if(Auth::user()->hasPermission('MANAGE_COMPANIES'))
                                        <th>Admin</th>
                                    @endif
                                    @if(Auth::user()->hasPermission('MANAGE_COMPANIES'))
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    {{--Name--}}
                                    <td><a href="{{ url('companies/' . $company->id) }}">{{ $company->name }}</a></td>

                                    {{--Media--}}
                                    <td class="text-center">
                                        <a href="{{ url('companies/' . $company->id . '/medias') }}" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View</a>
                                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                                            <a href="{{ url('companies/' . $company->id . '/medias/create') }}" class="btn btn-primary btn-xs">
                                                <i class="fa fa-plus"></i> Add
                                            </a>
                                        @endif
                                    </td>

                                    {{--Products--}}
                                    <td class="text-center">
                                        <a href="{{ url('companies/' . $company->id . '/products') }}" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View</a>
                                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                                            <a href="{{ url('companies/' . $company->id . '/products/create') }}" class="btn btn-primary btn-xs">
                                                <i class="fa fa-plus"></i> Add
                                            </a>
                                        @endif
                                    </td>

                                    {{--Users--}}
                                    <td class="text-center">
                                        <a href="{{ url('companies/' . $company->id . '/users') }}" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View</a>
                                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                                            <a href="{{ url('companies/' . $company->id . '/add-user') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add</a>
                                        @endif
                                    </td>

                                    {{--Events--}}
                                    <td class="text-center">
                                        <a href="{{ url('companies/' . $company->id . '/events') }}" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View</a>
                                    </td>

                                    {{--Admin--}}
                                    @if(Auth::user()->hasPermission('MANAGE_COMPANIES'))
                                        <td class="text-center">
                                            <a href="{{ url('companies/' . $company->id . '/admins') }}" class="btn btn-info btn-xs"><i class="fa fa-folder"></i> View</a>
                                            <a href="{{ url('companies/' . $company->id . '/add-admin') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add</a>
                                        </td>
                                    @endif

                                    {{--Actions--}}
                                    @if(Auth::user()->hasPermission('MANAGE_COMPANIES'))
                                        <td>
                                            <div class="text-center">
                                                @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                                                    <a href="{{ url('companies/' . $company->id . '/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                @endif
                                                @if(Auth::user()->hasPermission('MANAGE_COMPANIES'))
                                                    <span class="btn btn-danger btn-xs delete-span" data-toggle="modal" data-target="#delete-modal-{{ $company->id }}"><i class="fa fa-trash-o"></i> Delete </span>
                                                @endif
                                            </div>
                                            @if(Auth::user()->hasPermission('MANAGE_COMPANIES'))
                                                <div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="delete-modal-{{ $company->id }}">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel2">Delete confirmation</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4>Delete {{ $company->name }}</h4>
                                                                <p>Are you sure you want to delete company {{ $company->name }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <form action="{{ url('companies/' . $company->id) }}" method="POST" class="delete-form">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    @endif
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
        $('#companies-table').DataTable();
    });
</script>
@endpush