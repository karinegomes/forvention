@extends('include.breadcrumb')

@section('breadcrumb')
    @if(!isset($url) && !isset($title))
        <li class="active">Users</li>
    @else
        <li><a href="#">Users</a></li>
        <li class="active">{{ $title }}</li>
    @endif
@endsection