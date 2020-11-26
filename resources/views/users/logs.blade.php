@extends('layout')

@push('styles')
<style>
    .uk-heading-medium, .uk-heading-divider {
        background: transparent !important;
        color: #ffffff !important;
        font-family: hanimation
    }
</style>
@endpush

@section('content')
    <div class="uk-grid-small uk-grid-divider" uk-grid>
        <div class="uk-width-auto">
            <a class="uk-heading-divider" href="{{ route('users.index') }}" uk-icon="icon: users"></a>
        </div>
        <div class="uk-width-expand">
            <h1 class="uk-heading-medium uk-heading-divider">{{ __('users.log', ['user' => $name]) }}</h1>
        </div>
    </div>

    <div>
        @include('shared._log', ['logs' => $logs])
    </div>
@endsection

@push('scripts')
@endpush
