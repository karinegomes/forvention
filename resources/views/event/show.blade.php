@extends('template')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Events</h3>
                </div>
                @include('event.include.breadcrumb', ['title' => 'View Event'])
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>View Event - {{ $event->title }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-1">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $event->title }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $event->description }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Date</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $event->date }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Start time</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $event->start }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">End time</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $event->end }}</p>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-3">
                                {{--TODO: Show image--}}
                                <img src="{{ asset($event->image) }}" class="company-logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection