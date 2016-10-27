@extends('include.breadcrumb')

@section('breadcrumb')
    <li class=""><a href="{{ url('companies') }}">Companies</a></li>

    @if(isset($url))
        <li class=""><a href="{{ url($url) }}">Products</a></li>
    @endif

    @if(isset($title))
        <li class="active">{{ $title }}</li>
    @endif
@endsection