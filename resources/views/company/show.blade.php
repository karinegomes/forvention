@extends('template')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Companies</h3>
                </div>
                @include('company.include.breadcrumb', ['title' => 'View Company'])
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>View Company - {{ $company->name }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-1">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->address }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">City</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->city }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">State</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->state }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->country }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Zip code</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->zip_code }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->phone1 }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->phone2 }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Fax</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->fax }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $company->email }}</p>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-3">
                                {{--TODO: Show logo--}}
                                <img src="{{ asset($company->logo) }}" class="company-logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection