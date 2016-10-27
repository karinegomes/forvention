@extends('template')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Companies</h3>
                </div>
                @include('product.include.breadcrumb', [
                    'title' => 'Edit Product',
                    'url' => 'companies/' . $company->id . '/products'
                ])
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Company {{ $company->name }} - Edit Product {{ $product->title }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('include.error')

                            <form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data"
                                  action="{{ url('companies/' . $company->id . '/products/' . $product->id) }}">
                                {{ method_field('PATCH') }}
                                @include('product.include.form', ['edit' => true])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@include('product.include.scripts')