<div id="reset">
    <a class="uk-button uk-button-default" href="{{ route('monitor') }}" uk-icon="icon: cog"></a>
</div>

<div id="screen-id" class="uk-width-1-4 uk-padding-remove uk-grid-small" uk-grid>
    <div>
        <span id="screen-number" class="uk-label uk-label-success uk-text-large">{{ $screen }}</span>
    </div>
</div>

<div id="vision">
    <img data-src="{{ url('images/vision.png') }}" alt="vision" width="100" uk-img>
</div>

<div id="logo">
    <img data-src="{{ url('images/logo-large.png') }}" alt="vision" width="75" uk-img>
</div>
