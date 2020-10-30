@extends('layout')

@push('styles')
@endpush

@section('content')
<div>
    <a class="uk-button uk-button-default" href="{{ route('lectures.download') }}" uk-toggle style="color: #ffffff"><span uk-icon="cloud-download"></span>&nbsp;&nbsp;{{ __('schedules.download') }}</a>
</div>
@endsection

@push('scripts')
@endpush
