@extends('layout.head')
@section('body')
    @include('layout.nav')
    <header>
        <div class="container header-container">
            <div class="title-container">
                <h1 id="main-title" class="neon-text-effect-magenta">MusicGuessr</h1>
                <span id="subtitle" class="neon-text-effect-cyan">by Maëlys Alessio Simon</span>
            </div>
        </div>
    </header>
    <!-- Begin page content -->
    <section class="container">
        @yield('content')
    </section>
@endsection
