@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Modifier un album')
        @endslot

        <form method="POST" action="{{ route('album.update', $album->id) }}">
            @csrf
            @method('PUT')

            @include('partials.form-group', [
                'title' => __('Nom'),
                'type' => 'text',
                'name' => 'name',
                'value' => $album->name,
                'required' => true,
                ])

            @component('components.button')
                @lang('Envoyer')
            @endcomponent

        </form>

    @endcomponent            

@endsection

