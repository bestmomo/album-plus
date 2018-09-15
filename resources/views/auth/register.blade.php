@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Inscription')
        @endslot

        <form method="POST" action="{{ route('register') }}">
            @csrf

            @include('partials.form-group', [
                'title' => __('Nom'),
                'type' => 'text',
                'name' => 'name',
                'required' => true,
                ])

            @include('partials.form-group', [
                'title' => __('Adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => true,
                ])

            @include('partials.form-group', [
                'title' => __('Mot de passe'),
                'type' => 'password',
                'name' => 'password',
                'required' => true,
                ])

            @include('partials.form-group', [
                'title' => __('Confirmation du mot de passe'),
                'type' => 'password',
                'name' => 'password_confirmation',
                'required' => true,
                ])

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="ok" name="ok" required>
                    <label class="custom-control-label" for="ok"> @lang('J\'accepte les termes et conditions de la politique de confidentialité.')</label>
                </div>
            </div>

            @component('components.button')
                @lang('Inscription')
            @endcomponent

        </form>

    @endcomponent

@endsection
