@extends('layouts.form')

@section('card')

    @component('components.card')

        @slot('title')
            @lang('Ajouter une image')
        @endslot

        <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                <div class="custom-file">
                    <input type="file" id="image" name="image"
                           class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input" required>
                    <label class="custom-file-label" for="image"></label>
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>
                <br>
            </div>

            <div class="form-group">
                <img id="preview" class="img-fluid" src="#" alt="">
            </div>

            <div class="form-group">
                <label for="category_id">@lang('Catégorie')</label>
                <select id="category_id" name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            @include('partials.form-group', [
                'title' => __('Description (optionnelle)'),
                'type' => 'text',
                'name' => 'description',
                'required' => false,
                ])

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="adult" name="adult">
                    <label class="custom-control-label" for="adult"> @lang('Contenu adulte')</label>
                </div>
            </div>

            @component('components.button')
                @lang('Envoyer')
            @endcomponent

        </form>

    @endcomponent

@endsection

@section('script')

    <script>
        $(() => {
            $('input[type="file"]').on('change', (e) => {
                let that = e.currentTarget
                if (that.files && that.files[0]) {
                    $(that).next('.custom-file-label').html(that.files[0].name)
                    let reader = new FileReader()
                    reader.onload = (e) => {
                        $('#preview').attr('src', e.target.result)
                    }
                    reader.readAsDataURL(that.files[0])
                }
            })
        })
    </script>

@endsection
