@extends('template')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Company {{ $company->name }} - Products</h3>
            </div>
            @include('company.include.breadcrumb', ['title' => 'Products'])
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>View Products</h2>

                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{{ url('companies/' . $company->id . '/products/create') }}">
                                        <i class="fa fa-plus"></i> Add Product
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

                        <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-2">
                            @include('product.include.table')
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

<script>
    $(document).ready(function () {
        $('#products-table').DataTable();
    });
</script>
@endpush