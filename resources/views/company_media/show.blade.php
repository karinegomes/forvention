@extends('template')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Company {{ $company->name }} - Medias</h3>
                </div>

                @include('company_media.include.breadcrumb', [
                    'title' => 'View Media',
                    'url' => 'companies/' . $company->id . '/medias'
                ])
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Company {{ $company->name }} - Media {{ $media->title }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-1">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $media->title }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">File name</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $media->file_name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $media->description }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <a href="{{ $media->absolute_path }}" target="_blank">
                                                <button type="button" class="btn btn-primary">View file</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection