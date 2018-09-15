@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Mode maintenance')
        @endslot

        <form method="POST" action="{{ route('maintenance.update') }}">
            @csrf
            @method('PUT')

            @component('components.checkbox', [
                    'name' => 'maintenance',
                    'label' => __('Mode maintenance'),
                    'checked' => $maintenance ? 'checked' : ''
                ])
            @endcomponent

            @component('components.checkbox', [
                    'name' => 'ip',
                    'label' => __('Autoriser mon IP ') . '(' . $ip . ')',
                    'checked' => $ipChecked ? 'checked' : ''
                ])
            @endcomponent

            @component('components.button')
                @lang('Envoyer')
            @endcomponent

        </form>

    @endcomponent            

@endsection

