@extends('layouts.app')

@section('content')
<div class="uk-container uk-container-large">
    <div class="uk-grid-large uk-text-center" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body button" uk-tooltip="title: Hello World; pos: top">
                <span uk-icon="icon: users; ratio: 2.0"></span>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body button" uk-tooltip="title: Hello World; pos: top">
                <span uk-icon="icon: clock; ratio: 2.0"></span>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body button" uk-tooltip="title: Hello World;pos: top">
                <span uk-icon="icon: calendar; ratio: 2.0"></span>
            </div>
        </div>
    </div>

    <div class="uk-grid-large uk-text-center" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body button" uk-tooltip="title: Hello World;pos: bottom">
                <span uk-icon="icon: thumbnails; ratio: 2.0"></span>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body button" uk-tooltip="title: Hello World;pos: bottom">
                <span uk-icon="icon: user; ratio: 2.0"></span>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body button" uk-tooltip="title: Hello World;pos: bottom">
                <span uk-icon="icon: info; ratio: 2.0"></span>
            </div>
        </div>
    </div>
</div>
@endsection
