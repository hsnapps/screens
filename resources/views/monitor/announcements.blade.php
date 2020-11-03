<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: fade; autoplay: true; finite: false; ratio: false; draggable: false; autoplay-interval: 30000; pause-on-hover: false">
    <ul class="uk-slideshow-items" uk-height-viewport="offset-top: true; offset-bottom: true">
        @foreach ($announcements as $item)
        <li>
            @switch($item->type)
                @case('photo')
                    <img src="{{ url('content/'.$item->value) }}" alt="" uk-cover>
                    @break

                @case('video')
                    <video src="{{ url('content/'.$item->value) }}" loop muted playsinline uk-video="autoplay: inview"></video>
                    @break

                @case('pdf')
                    <embed src="{{ url('content/'.$item->value) }}" type="application/pdf" width="100%" height="600px" />
                    @break

                @default
                    <div class="uk-text-center uk-height-1-1">
                        <h1 style="color: #1a4e3e" class="uk-margin-xlarge-top">{{ $item->value }}</h1>
                    </div>
            @endswitch
        </li>
        @endforeach
    </ul>
</div>
