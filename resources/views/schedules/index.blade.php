@extends('layout')

@push('styles')
<style>
    .uk-button-default {
        color: #ffffff !important;
    }
</style>
@endpush

@section('content')
@include('shared.validation')

<div uk-grid>
    <div class="uk-form-horizontal">
        <a class="uk-button uk-button-default" href="{{ route('schedules.download') }}"><span uk-icon="cloud-download"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('schedules.download') }}</a>
    </div>
    <form class="uk-form-horizontal" action="{{ route('schedules.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div uk-form-custom>
            <input type="file" name="excel">
            <button class="uk-button uk-button-default" type="button" tabindex="-1"><span uk-icon="cloud-upload"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('schedules.select-file') }}</button>
        </div>
        <button class="uk-button uk-button-secondary uk-margin-right-small">{{ __('schedules.upload') }}</button>
    </form>
</div>
@endsection

@push('scripts')
@endpush
