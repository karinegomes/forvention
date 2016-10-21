@extends('template')

@include('event.include.css')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
            </div>
            @include('event.include.breadcrumb', ['title' => 'Add Event'])
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Event</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @include('include.error')

                        <form data-parsley-validate class="form-horizontal form-label-left"
                              action="{{ url('events') }}" method="POST" enctype="multipart/form-data">
                            @include('event.include.form', ['edit' => false])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@include('event.include.scripts', ['edit' => false])