@extends('layout')

@section('content')
<div class="uk-grid-large uk-child-width-expand@s uk-text-center" uk-grid>
    @foreach (array_slice(__('dashboard'), 0, 3) as $item)
    <div>
        <div class="uk-card uk-card-default uk-card-body button" data-link="{{ $item[2] }}" uk-tooltip="title: {{ $item[1] }}; pos: top">
            <span uk-icon="icon: {{ $item[0] }}; ratio: 2.0"></span>
        </div>
    </div>
    @endforeach
</div>

<div class="uk-grid-large uk-child-width-expand@s uk-text-center" uk-grid>
    @foreach (array_slice(__('dashboard'), 3) as $item)
    <div>
        @if ($item[0] == 'ignore')
        <div class="uk-card uk-card-default uk-card-body uk-padding">
            <img data-src="{{ url('images/cte.jpg') }}" alt="" uk-img>
        </div>
        @else
        <div class="uk-card uk-card-default uk-card-body button" data-link="{{ $item[2] }}" uk-tooltip="title: {{ $item[1] }}; pos: bottom">
            <span uk-icon="icon: {{ $item[0] }}; ratio: 2.0"></span>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
@endpush
