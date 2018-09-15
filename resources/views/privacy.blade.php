@extends('layouts.app')

@section('content')
    <main class="container-fluid">
        @component('components.card')

            @slot('title')
                @lang('Politique de confidentialité')
            @endslot

            <p class="card-text">@lang('
    Sed cautela nimia in peiores haeserat plagas, ut narrabimus postea, aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in hoc causarum titulo dissimilem sui.')</p>

        @endcomponent
    </main>
@endsection

