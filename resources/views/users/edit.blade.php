@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Modifier un utilisateur')
        @endslot

        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')

            @include('partials.form-group', [
                'title' => __('Nom'),
                'type' => 'text',
                'name' => 'name',
                'value' => $user->name,
                'required' => true,
                ])

            @include('partials.form-group', [
                'title' => __('Email'),
                'type' => 'email',
                'name' => 'email',
                'value' => $user->email,
                'required' => true,
                ])

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="adult" name="adult" {{ $user->settings->adult ? 'checked' : '' }}>
                    <label class="custom-control-label" for="adult"> @lang('Adulte')</label>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="verified" name="verified" {{ $user->hasVerifiedEmail() ? 'checked' : '' }}>
                    <label class="custom-control-label" for="verified"> @lang('Vérifié')</label>
                </div>
            </div>

            @component('components.button')
                @lang('Envoyer')
            @endcomponent

        </form>

    @endcomponent            

@endsection

