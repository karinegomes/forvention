@extends('template')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Users</h3>
                </div>
                @include('user.include.breadcrumb', ['title' => 'View Favorite Products'])
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User {{ $user->name }} - View Favorite Products</h2>

                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3">
                                <table id="favorite-products-table" cellspacing="0" width="100%"
                                       class="table table-bordered table-striped dt-responsive nowrap hover">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Company</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <a href="{{ url('companies/' . $product->company->id . '/products/' .
                                                    $product->id) }}">{{ $product->title }}</a>
                                            </td>
                                            <td>{{ $product->company->name }}</td>
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
        $('#favorite-products-table').DataTable();
    });
</script>
@endpush