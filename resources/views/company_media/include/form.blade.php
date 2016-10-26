{{ csrf_field() }}

@if($edit)
    <input type="hidden" id="edit" name="edit" value="edit">
@endif

<div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-1">
    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
            File title <span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" id="title" name="title" class="form-control" value="{{ old('file_name', $edit ? $media->file_name : '') }}" {{--required--}}>
        </div>
    </div>

    <div class="form-group {{ $errors->has('file_name') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file_name">
            File <span class="required">*</span>
        </label>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <input type="text" id="file_name" name="file_name" class="form-control col-md-7 col-xs-12" value="{{ old('file_name', $edit ? $media->file_name : '') }}" {{--required--}}>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12">
            <div style="height:0; overflow:hidden">
                <input type="file" id="file" name="file"/>
            </div>
            <button type="button" class="btn btn-primary btn-block" id="choose-file">Choose file</button>
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
            Description <span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea id="description" name="description" class="form-control col-md-7 col-xs-12">{{ old('description', $edit ? $media->description : '') }}</textarea>
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