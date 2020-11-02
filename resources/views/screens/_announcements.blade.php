<div class="uk-card uk-card-header">
    <div class="uk-card-body uk-padding-remove">
        <div class="uk-overflow-auto">
            <button class="uk-button uk-button-default add-content" type="button" uk-toggle="target: .add-content">{{ __('announcements.add') }}</button>
            @include('screens._add')
        </div>
    </div>
</div>

<div class="uk-margin-top-remove">
    <table class="uk-table uk-table-hover uk-table-striped ">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('announcements.type') }}</th>
                <th>{{ __('announcements.value') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screen->announcements as $announcement)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ __('announcements.types')[$announcement->type] }}</td>
                <td>{{ $announcement->type == 'text' ? $announcement->value : '' }}</td>
                <td>
                    <button class="uk-button uk-button-secondary" uk-toggle="target: #modal-{{ $announcement->id }}"><span uk-icon="icon: search"></span></button>
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
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
