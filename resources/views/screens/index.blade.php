@extends('layout')

@push('styles')
<style>
    .uk-padding { padding: 30px !important; }
</style>
@endpush

@section('content')
@for($i = 1; $i < 40; $i += 10)
<div class="uk-grid-small uk-text-center" uk-grid>
    @foreach (App\Screen::whereBetween('id', [$i, $i + 9])->get() as $screen)
    <div style="">
        <a class="uk-button uk-button-default uk-padding uk-text-large" style="font-family: 'Courier New', Courier, monospace" href="{{ route('screens.show', ['screen' => $screen]) }}">{{ sprintf('%02d', $screen->id) }}</a>
    </div>
    @endforeach
</div>
@endfor
@endsection

@push('scripts')
@endpush
