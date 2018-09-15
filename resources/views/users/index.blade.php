@extends('layouts.form-wide')

@section('css')

    <style>
        .fa-check {
            color: green;
        }
    </style>

@endsection


@section('card')

    @component('components.card')

        @slot('title')
            @lang('Gestion des utilisateurs (administrateurs en rouge)')
        @endslot

        <div class="table-responsive">
            <table class="table table-dark text-white">
                <thead>
                    <tr>
                        <th scope="col">@lang('Nom')</th>
                        <th scope="col">@lang('Email')</th>
                        <th scope="col">@lang('Inscription')</th>
                        <th scope="col">@lang('Vérifié')</th>
                        <th scope="col">@lang('Adulte')</th>
                        <th scope="col">@lang('Photos')</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr @if($user->admin) style="color: red" @endif>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->formatLocalized('%x') }}</td>
                        <td>@if($user->email_verified_at){{ $user->email_verified_at->formatLocalized('%x') }}@endif</td>
                        <td>@if($user->adult)<i class="fas fa-check fa-lg"></i>@endif</td>
                        <td>{{ $user->images_count }}</td>
                        <td>
                            <a type="button" href="{{ route('user.edit', $user->id) }}"
                               class="btn btn-warning btn-sm pull-right mr-2 invisible" data-toggle="tooltip"
                               title="@lang("Modifier l'utilisateur") {{ $user->name }}"><i
                                        class="fas fa-edit fa-lg"></i></a>
                        </td>
                        <td>
                            @unless($user->admin)
                            <a type="button" href="{{ route('user.destroy', $user->id) }}"
                               class="btn btn-danger btn-sm pull-right invisible" data-toggle="tooltip"
                               title="@lang("Supprimer l'utilisateur") {{ $user->name }}"><i
                                        class="fas fa-trash fa-lg"></i></a>
                            @endunless
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    @endcomponent

@endsection

@section('script')

    <script>
        $(() => {
            $('a').removeClass('invisible')
        })
    </script>

    @include('partials.script-delete', ['text' => __('Vraiment supprimer cet utilisateur ?'), 'return' => 'removeTr'])

@endsection
