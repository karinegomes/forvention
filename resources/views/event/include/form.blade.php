{{ csrf_field() }}

@if($edit)
    <input type="hidden" id="edit" name="edit" value="edit">
@endif

<div class="col-md-8 col-sm-8 col-xs-8">
    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" id="title" name="title" class="form-control col-md-7 col-xs-12"
                   value="{{ old('title', $edit ? $event->title : '') }}">
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
            Description <span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        <textarea id="description" name="description" class="form-control col-md-7
            col-xs-12">{{ old('description', $edit ? $event->description : '') }}</textarea>
        </div>
    </div>

    <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">
            Date <span class="required">*</span>
        </label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <div class="input-prepend input-group">
                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                <input type="text" name="date" id="date" class="form-control"
                       value="{{ old('date', $edit ? $event->date : '') }}">
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start">
            Start time <span class="required">*</span>
        </label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <div class="input-prepend input-group bootstrap-timepicker timepicker">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                <input id="start" name="start" type="text" class="form-control input-small"
                       value="{{ old('start', $edit ? $event->start : '') }}">
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('end') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end">
            End time <span class="required">*</span>
        </label>
        <div class="col-md-3 col-sm-3 col-xs-9">
            <div class="input-prepend input-group bootstrap-timepicker timepicker">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                <input id="end" name="end" type="text" class="form-control input-small"
                       value="{{ old('end', $edit ? $event->end : '') }}">
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-4 text-center">
    <div class="row" style="margin-bottom: 10px;">
        {{--TODO: Load image on edit and maybe show a placeholder on create.--}}
        <img src="{{ $edit ? asset($event->image) : '' }}" style="max-width: 100%;" id="image-preview">
    </div>

    <div class="row">
        <div class="upload-tools">
            <div style="height:0; overflow:hidden">
                <input type="file" id="image" name="image" accept="image/*"/>
            </div>
            <button type="button" class="btn btn-primary" id="choose-image">Choose image</button>
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