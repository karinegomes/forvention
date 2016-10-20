@extends('include.breadcrumb')

@section('breadcrumb')
    @if(!isset($url) && !isset($title))
        <li class="active">Events</li>
    @else
        <li><a href="{{ url('events') }}">Events</a></li>
        <li class="active">{{ $title }}</li>
    @endif
@endsection