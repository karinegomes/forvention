@extends('include.breadcrumb')

@section('breadcrumb')
    @if(!isset($url) && !isset($title))
        <li class="active">Companies</li>
    @else
        <li><a href="{{ url('companies') }}">Companies</a></li>
        <li class="active">{{ $title }}</li>
    @endif
@endsection