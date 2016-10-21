{{ csrf_field() }}

@if($edit)
    <input type="hidden" id="edit" name="edit" value="edit">
@endif

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="name" name="name" class="form-control col-md-7 col-xs-12"
                   value="{{ old('name', $edit ? $user->name : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12"
                   value="{{ old('email', $edit ? $user->email : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="phone" name="phone" class="form-control col-md-7 col-xs-12"
                   value="{{ old('phone', $edit ? $user->phone : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">New password
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">
            Password confirmation
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control col-md-7 col-xs-12">
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="ln_solid"></div>

<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <a href="{{ url('events') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</div>