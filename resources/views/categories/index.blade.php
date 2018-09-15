@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Gestion des catégories')
        @endslot


        <table class="table table-dark text-white">
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a type="button" href="{{ route('category.destroy', $category->id) }}"
                           class="btn btn-danger btn-sm pull-right invisible" data-toggle="tooltip"
                           title="@lang('Supprimer la catégorie') {{ $category->name }}"><i
                                    class="fas fa-trash fa-lg"></i></a>
                        <a type="button" href="{{ route('category.edit', $category->id) }}"
                           class="btn btn-warning btn-sm pull-right mr-2 invisible" data-toggle="tooltip"
                           title="@lang('Modifier la catégorie') {{ $category->name }}"><i
                                    class="fas fa-edit fa-lg"></i></a>
                    </td>
                </tr>
            @endforeach
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

    @include('partials.script-delete', ['text' => __('Vraiment supprimer cette catégorie ?'), 'return' => 'removeTr'])

@endsection
