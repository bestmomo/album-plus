@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Ajouter un album')
        @endslot

        <form method="POST" action="{{ route('album.store') }}">
            @csrf

            @include('partials.form-group', [
                'title' => __('Nom'),
                'type' => 'text',
                'name' => 'name',
                'required' => true,
                ])

            @component('components.button')
                @lang('Envoyer')
            @endcomponent

        </form>

    @endcomponent

@endsection

