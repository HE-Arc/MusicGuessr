@extends('layout.app')
@section('content')

<p>Hi {{ Auth::user()->name }}, this is your personal dashboard</p>

@endsection
