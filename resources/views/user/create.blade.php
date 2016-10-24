@extends('template')

@include('user.include.css')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users</h3>
            </div>
            @include('user.include.breadcrumb', ['title' => 'Add User'])
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add User</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @include('include.error')

                        <form class="form-horizontal form-label-left" action="{{ url('users') }}" method="POST">
                            @include('user.include.form', ['edit' => false])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@include('user.include.scripts')