@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Gestion des albums')
        @endslot


        <table class="table table-dark text-white">
            <tbody>
            @if($userAlbums->isEmpty())
                <p class="text-center">@lang("Vous n'avez aucun album pour le moment")</p>
            @else
                @foreach($userAlbums as $album)
                    <tr>
                        <td>{{ $album->name }}</td>
                        <td>
                            <a type="button" href="{{ route('album.destroy', $album->id) }}"
                               class="btn btn-danger btn-sm pull-right invisible" data-toggle="tooltip"
                               title="@lang("Supprimer l'album") {{ $album->name }}"><i
                                        class="fas fa-trash fa-lg"></i></a>
                            <a type="button" href="{{ route('album.edit', $album->id) }}"
                               class="btn btn-warning btn-sm pull-right mr-2 invisible" data-toggle="tooltip"
                               title="@lang("Modifier l'album") {{ $album->name }}"><i
                                        class="fas fa-edit fa-lg"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    @endcomponent

@endsection

@section('script')

    <script>
        $(() => {
            $('a').removeClass('invisible')
        })
    </script>

    @include('partials.script-delete', ['text' => __('Vraiment supprimer cet album ?'), 'return' => 'removeTr'])

@endsection
