@extends('layouts/main')
@section('main')
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a href="{{ URL::route('controlPanel') }}">Control Panel</a>
                </li>
                <li><a href="{{ URL::route('measurements') }}">Current Measurements</a>
                </li>
                <li><a href="{{ URL::route('consumption') }}">Consumption</a>
                </li>
            </ul>
        </div>
        <div>
        	123
        </div>
    </div>
@stop
@section('moreScripts')
@stop