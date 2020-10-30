@extends('layout')

@push('styles')

@endpush

@section('content')
<ul class="uk-thumbnav" uk-margin>
    @foreach (App\Screen::all() as $screen)
    <li  title="{{ $screen->id }}" uk-tooltip >
        <a href="{{ route('screens.show', ['screen' => $screen]) }}"><img src="{{ url('images/default-background.png') }}" width="120" alt=""></a>
    </li>
    @endforeach
</ul>
@endsection

@push('scripts')

@endpush
