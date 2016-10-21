@extends('auth.template')

@section('content')
    <div id="register" class="form registration_form">
        <section class="login_content">
            <form action="{{ url('register') }}" method="POST">
                {{ csrf_field() }}
                <h1>Create Account</h1>
                <div>
                    <input type="text" class="form-control" placeholder="Name" name="name" required="" />
                </div>
                <div>
                    <input type="email" class="form-control" placeholder="Email" name="email" required="" />
                </div>
                <div>
                    <input type="text" class="form-control" placeholder="Phone" name="phone" required="" />
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" name="password" required="" />
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required="" />
                </div>
                <div>
                    <button type="submit" class="btn btn-default submit">Submit</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">Already a member?
                        <a href="{{ url('login') }}"> Log in </a>
                    </p>

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1>ForVention</h1>
                        <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection