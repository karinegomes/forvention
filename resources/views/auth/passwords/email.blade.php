@extends('auth.template')

@section('content')

    <div class="form login_form">
        <section class="login_content">

            <form action="{{ url('password/email') }}" method="POST">
                <h1>Reset password</h1>

                <div class="text-left">@include('include.error')</div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {{ csrf_field() }}

                <div>
                    <input type="email" class="form-control" name="email" placeholder="Email" required />
                </div>

                <div>
                    <button type="submit" class="btn btn-default submit">Send Password Reset Link</button>
                </div>

                <div class="clearfix"></div>
                <br>

                <div class="separator">
                    <br>
                    <a href="{{ url('/') }}"><h1>Forvention</h1></a>
                </div>
            </form>

        </section>
    </div>

@endsection
