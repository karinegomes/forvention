@extends('template')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Company {{ $company->name }} - Products</h3>
                </div>

                @include('product.include.breadcrumb', [
                    'title' => 'View Product',
                    'url' => 'companies/' . $company->id . '/products'
                ])
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Company {{ $company->name }} - Product {{ $product->title }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-8 col-sm-8 col-xs-8">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">SKU</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $product->sku }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $product->title }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $product->description }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Tags</label>
                                        <div class="col-sm-10">
                                            @foreach($product->tags as $tag)
                                                <p class="form-control-static">{{ $tag->name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <img src="{{ $product->image_absolute_path }}" class="company-logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection