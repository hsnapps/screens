<div id="modal-{{ $announcement->id }}" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <div>
            @switch($announcement->type)
                @case('photo')
                    <img data-src="{{ url('content/'.$announcement->value) }}" width="800" alt="" uk-img>
                    @break
                @case('video')
                    <video src="{{ url('content/'.$announcement->value) }}" controls playsinline uk-video="autoplay: inview; automute: true"></video>
                    @break
                @case('pdf')
                    <embed src="{{ url('content/'.$announcement->value) }}" type="application/pdf" width="100%" height="600px" />
                    @break
                @default
                <h1 class="text-center">{{ $announcement->value }}</h1>
            @endswitch
        </div>
        <p class="uk-text-left">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.close') }}</button>
        </p>
    </div>
</div>
