@extends('layouts.form')

@section('css')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">

@endsection

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Modifer le profil')
            <a href="{{ route('profile.destroy', $user->id) }}" class="btn btn-danger btn-sm pull-right invisible" role="button" aria-disabled="true"><i class="fas fa-angry fa-lg"></i> @lang('Supprimer mon compte')</a>
        @endslot

        <form method="POST" action="{{ route('profile.update', $user->id) }}">
            @csrf
            @method('PUT')

            @include('partials.form-group', [
                'title' => __('Adresse email'),
                'type' => 'email',
                'name' => 'email',
                'required' => true,
                'value' => $user->email,
            ])

            <div id="slider" class="form-group invisible">
                @lang('Pagination : ')<span id="nbr">{{ $user->settings->pagination }}</span> @lang('images par page')<br>
                <input id="pagination" name="pagination" type="number" data-slider-min="3" data-slider-max="20"
                       data-slider-step="1" data-slider-value="{{ $user->settings->pagination }}"/><br>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="adult" name="adult" {{ $user->settings->adult ? 'checked' : '' }}>
                    <label class="custom-control-label" for="adult"> @lang('Je déclare être adulte')</label>
                </div>
            </div>

            <a href="{{ route('profile.show', $user->id) }}" class="btn btn-warning invisible" role="button" aria-disabled="true"><i class="fas fa-dolly fa-lg"></i> @lang('Exporter mes données personnelles')</a>

            @component('components.button')
                @lang('Envoyer')
            @endcomponent

        </form>

    @endcomponent

@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.0/bootstrap-slider.min.js"></script>

    <script>
        $(() => {
            $("#pagination")
                .slider()
                .on("slide", (e) => {
                    $("#nbr").text(e.value)
                })
                .on("change", (e) => {
                    $("#nbr").text(e.value.newValue)
                })
            $('#slider, a').removeClass('invisible');
        })
    </script>

    @include('partials.script-delete', ['text' => __('Vraiment supprimer votre compte ?'), 'return' => 'home'])

@endsection