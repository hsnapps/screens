<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: fade; autoplay: true; draggable: false; autoplay-interval: 30000; pause-on-hover: false">
    <ul class="uk-slideshow-items" uk-height-viewport="offset-top: true; offset-bottom: true">
        @foreach ($announcements as $item)
        <li>
            @switch($item->type)
                @case('photo')
                    <img src="{{ url('content/'.$item->value) }}" alt="" uk-cover>
                    @break

                @case('video')
                    <video src="{{ url('content/'.$item->value) }}" loop muted playsinline uk-video="autoplay: inview" uk-cover></video>
                    @break

                @case('pdf')
                    <iframe src="{{ url('content/'.$item->value) }}" frameborder="0" width="100%" height="600px" uk-cover></iframe>
                    @break

                @default
                    <div class="uk-text-center uk-height-1-1">
                        <h1 style="color: #1a4e3e" class="uk-margin-xlarge-top">{{ $item->value }}</h1>
                        <h3 style="position: absolute; color: #1a4e3e; bottom: 25px;">{{ $item->user->name }}</h3>
                    </div>
            @endswitch
        </li>
        @endforeach
    </ul>
</div>
