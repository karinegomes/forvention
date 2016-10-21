@extends('auth.template')

@section('content')
    <div class="form login_form">
        <section class="login_content">
            <form action="{{ url('login') }}" method="POST">
                {{ csrf_field() }}

                <h1>Login</h1>
                <div class="text-left">
                    @include('include.error')
                </div>
                <div>
                    <input type="text" class="form-control" name="email" placeholder="Email" required="" />
                </div>
                <div>
                    <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                </div>
                <div>
                    <button class="btn btn-default submit" type="submit">Log in</button>
                    <a class="reset_pass" href="#">Lost your password?</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">New to site?
                        <a href="{{ url('register') }}"> Create Account </a>
                    </p>

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1>Forvention</h1>
                        <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection