@extends('template')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Companies</h3>
            </div>
            @include('company.include.breadcrumb', ['title' => 'Add Company'])
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Company</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @include('include.error')

                        <form data-parsley-validate class="form-horizontal form-label-left"
                              action="{{ url('companies') }}" method="POST" enctype="multipart/form-data">
                            @include('company.include.form', ['edit' => false])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection