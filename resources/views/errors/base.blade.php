@extends('layouts.app')

@section('content')

  <div class="site-wrapper">
    <main role="main" class="site-wrapper-inner text-white text-center">
      <h1>@yield('title')</h1>
      <p class="lead">@yield('text')</p>
    </main>
  </div>

@endsection
