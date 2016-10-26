{{ csrf_field() }}

@if($edit)
    <input type="hidden" id="edit" name="edit" value="edit">
@endif

<div class="col-md-8 col-sm-8 col-xs-8">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="name" name="name" class="form-control col-md-7 col-xs-12"
                   value="{{ old('name', $edit ? $company->name : '') }}" required>
        </div>
    </div>

    {{--<div class="form-group"  {{ $errors->has('logo') ? 'has-error' : '' }}>
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">
            Logo <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="file" id="logo" name="logo" {{ $edit ? '' : 'required' }}>
        </div>
    </div>
    --}}{{--TODO: Show logo thumbnail--}}

    <div class="form-group  {{ $errors->has('address') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">
            Address <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="address" name="address" class="form-control col-md-7 col-xs-12" required
                   value="{{ old('address', $edit ? $company->address : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="city" name="city" required="required" class="form-control col-md-7 col-xs-12"
                   value="{{ old('city', $edit ? $company->city : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">State <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="state" name="state" required="required" class="form-control col-md-7 col-xs-12"
                   value="{{ old('state', $edit ? $company->state : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">
            Country <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="country" name="country" required="required"
                   class="form-control col-md-7 col-xs-12" value="{{ old('country', $edit ? $company->country : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zip_code">
            Zip code <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="zip_code" name="zip_code" required="required"
                   class="form-control col-md-7 col-xs-12" value="{{ old('zip_code', $edit ? $company->zip_code : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('phone1') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone1">
            Phone <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="phone1" name="phone1" required="required"
                   class="form-control col-md-7 col-xs-12" value="{{ old('phone1', $edit ? $company->phone1 : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('phone2') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone2">Phone</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="phone2" name="phone2" class="form-control col-md-7 col-xs-12"
                   value="{{ old('phone2', $edit ? $company->phone2 : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('fax') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax">Fax</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="fax" name="fax" class="form-control col-md-7 col-xs-12"
                   value="{{ old('fax', $edit ? $company->fax : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
            Email <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="email" id="email" name="email" required="required"
                   class="form-control col-md-7 col-xs-12" value="{{ old('email', $edit ? $company->email : '') }}">
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-4 text-center">
    <div class="row" style="margin-bottom: 10px;">
        {{--TODO: Show a placeholder on create.--}}
        <img src="{{ $edit ? asset($company->logo) : '' }}" style="max-width: 100%;" id="image-preview">
    </div>

    <div class="row">
        <div class="upload-tools">
            <div style="height:0; overflow:hidden">
                <input type="file" id="logo" name="logo" accept="image/*"/>
            </div>
            <button type="button" class="btn btn-primary" id="choose-image">Choose logo</button>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="ln_solid"></div>

<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <a href="{{ url('companies') }}"><button type="button" class="btn btn-primary">Cancel</button></a>
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</div>