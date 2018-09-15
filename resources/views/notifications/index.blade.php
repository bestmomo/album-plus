@extends('layouts.app')

@section('content')
    <main class="container-fluid">
        <h1>@lang('Notation de vos photos')</h1>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 140px">
                        <thead>
                            <tr>
                                <th>@lang('Photo')</th>
                                <th>@lang('Note')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->unreadNotifications as $notification)
                                <tr>
                                    <td>
                                        <div class="hover_img">
                                            <a href="{{ url('images/' . $notification->data['image']) }}" target="_blank">{{ url('images/' . $notification->data['image']) }}<span><img src="{{ url('thumbs/' . $notification->data['image']) }}" alt="image" height="150" /></span></a>
                                        </div>
                                    </td>
                                    <td>{{ $notification->data['rate'] }}</td>
                                    <td>
                                        <form action="{{ route('notification.update', $notification->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="submit" class="btn btn-success btn-sm" value="@lang('Marquer comme lu')">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </main>
@endsection

