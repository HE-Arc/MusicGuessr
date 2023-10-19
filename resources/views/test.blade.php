@extends('layout.app')
@section('content')
<div id="app">
    <test-component></test-component>
</div>
@vite(['resources/js/pages/test.js'])
@endsection
