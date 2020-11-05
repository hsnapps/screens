@extends('layout')

@push('styles')
<style>
    .uk-padding { padding: 30px !important; }
    .uk-width-1-6 { font-family: 'Courier New', Courier, monospace; }
</style>
@endpush

@section('content')
@php
    $i = 0;
@endphp

@while ($i < App\Screen::count())
    <div class="uk-child-width-expand@s uk-text-center uk-text-large button" uk-grid>
        @foreach (App\Screen::all()->skip($i)->take(5) as $screen)
        <div class="uk-width-1-5" data-link="{{ route('screens.show', ['screen' => $screen]) }}">
            @if (isset($screen->hall))
                <div class="uk-card uk-card-default uk-card-body">{{ $screen->id }}<br>{{ $screen->hall }}</div>
            @else
                <div class="uk-card uk-card-default uk-card-body uk-background-muted">{{ $screen->id }}<br>{{ __('screens.free') }}</div>
            @endif
        </div>
        @endforeach
    </div>

    @php
        $i += 6;
    @endphp
@endwhile

@endsection

@push('scripts')
@endpush
