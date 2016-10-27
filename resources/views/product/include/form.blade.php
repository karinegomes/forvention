{{ csrf_field() }}

@if($edit)
    <input type="hidden" id="edit" name="edit" value="edit">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
@endif

<div class="col-md-8 col-sm-8 col-xs-8">
    <div class="form-group {{ $errors->has('sku') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sku">
            SKU <span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" id="sku" name="sku" class="form-control" value="{{ old('sku', $edit ? $product->sku : '') }}" required>
        </div>
    </div>

    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
            Title <span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $edit ? $product->title : '') }}" required>
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
            Description <span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <textarea id="description" name="description" class="form-control col-md-7 col-xs-12" required>{{ old('description', $edit ? $product->description : '') }}</textarea>
        </div>
    </div>

    <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tags">
            Tags <span class="required">*</span>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input name="tags" id="tags" value="{{ old('tags', $edit ? $product->implodedTags() : '') }}" /> {{--TODO: Create a function that returns the imploded tags--}}
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12 text-center">
    <div class="row" style="margin-bottom: 10px;">
        {{--TODO: Show a placeholder on create.--}}
        <img src="{{ $edit ? $product->image_absolute_path : '' }}" style="max-width: 100%;" id="image-preview">
    </div>

    <div class="row">
        <div class="upload-tools">
            <div style="height:0; overflow:hidden">
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="button" class="btn btn-primary" id="choose-image">Choose image</button>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="ln_solid"></div>

<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <a href="{{ url('companies/' . $company->id . '/products') }}">
            <button type="button" class="btn btn-primary">Cancel</button>
        </a>

        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</div>