@extends('template')

@push('css')
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Companies</h3>
                </div>
                @include('company.include.breadcrumb', ['title' => 'Add User'])
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add User to Company {{ $company->name }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('include.error')

                            <form data-parsley-validate class="form-horizontal form-label-left" method="POST"
                                  action="{{ url('companies/' . $company->id . '/add-user') }}">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}"
                                     id="email-wrapper">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                                        Email <span class="required">*
                                        </span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group"  {{ $errors->has('role') ? 'has-error' : '' }}>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role">
                                        Role <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="role" id="role" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}"
                                                        {{ old('role') == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('companies') }}">
                                            <button type="button" class="btn btn-primary">Cancel</button>
                                        </a>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#email").autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: BASE_URL + "/user-autocomplete",
                        data: {
                            term: request.term
                        },
                        success: function( data ) {
                            console.log(data);
                            response(data);
                        }
                    });
                },
                minLength: 2,
                appendTo: '#email-wrapper'
            } );
        });
    </script>
@endpush