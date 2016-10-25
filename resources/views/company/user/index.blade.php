@extends('template')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Companies</h3>
            </div>
            @include('company.include.breadcrumb', ['title' => 'View Users'])
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Company {{ $company->name }} - View Users</h2>

                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{{ url('companies/' . $company->id . '/add-user') }}">
                                        <i class="fa fa-plus"></i> Add User
                                    </a>
                                </li>
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

                        <table id="company-users-table" cellspacing="0" width="100%"
                               class="table table-bordered table-striped dt-responsive nowrap hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                @if(Auth::user()->mainRole && Auth::user()->mainRole->hasPermission('MANAGE_COMPANIES') || Auth::user()->hasManageCompanyInfoPermission())
                                    <th>Actions</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $roleName }}</td>
                                    @if(Auth::user()->mainRole && Auth::user()->mainRole->hasPermission('MANAGE_COMPANIES') || Auth::user()->hasManageCompanyInfoPermission($company->id))
                                        <td>
                                            <div class="text-center">
                                                <span class="btn btn-danger btn-xs delete-span" data-toggle="modal" data-target="#delete-modal-{{ $user->id }}">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </span>
                                            </div>
                                            @include('include.modal', [
                                                'id' => $user->id,
                                                'deleteTitle' => 'Delete ' . $user->name . ' from ' . $company->name,
                                                'deleteMessage' => 'Are you sure you want to remove ' . $user->name . ' from ' . $company->name . '?',
                                                'url' => 'companies/' . $company->id . '/user/' . $user->id . '/role/' . $user->pivot['role_id'] . '/delete'
                                            ])
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
        $('#company-users-table').DataTable();
    });
</script>
@endpush