@extends('layout.head')
@section('body')
    @include('layout.nav')
    <header>
        <div class="container header-container">
            <div class="title-container">
                <a href="/">
                    <h1 id="main-title" class="neon-text-effect-magenta">MusicGuessr</h1>
                </a>
                <span id="subtitle" class="neon-text-effect-cyan">by Maëlys Alessio Simon</span>
            </div>
        </div>
    </header>
    @yield('content')
@endsection
