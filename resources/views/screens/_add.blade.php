<form class="uk-form-stacked add-content" action="{{ route('announcements.create') }}" method="post" enctype="multipart/form-data" hidden>
    <fieldset class="uk-fieldset">
        <div class="uk-margin">
            <label class="uk-form-label" for="type">{{ __('announcements.type') }}</label>
            <div class="uk-form-controls">
                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    @foreach (__('announcements.types') as $key => $value)
                    <label><input class="uk-radio" type="radio" name="type" value="{{ $key }}" {{ $key == 'text' ? 'checked' : '' }}> {{ $value }}</label>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="content-text" class="uk-margin">
            <label class="uk-form-label" for="value">{{ __('announcements.value') }}</label>
            <textarea name="text" class="uk-textarea" rows="5" placeholder="{{ __('announcements.value') }}"></textarea>
        </div>
        <div id="content-file" class="uk-margin" hidden>
            <label class="uk-form-label" for="value">{{ __('announcements.value') }}</label>
            <div uk-form-custom>
                <input type="file" name="content">
                <button class="uk-button uk-button-default" type="button" tabindex="-1">{{ __('schedules.select-file') }}</button>
            </div>
            <button id="file-name" class="uk-button uk-button-text uk-margin-small-right" disabled></button>
        </div>

        <div class="uk-margin">
            <div class="uk-width-1-1" uk-grid>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="value">{{ __('announcements.from') }}</label>
                    <input type="datetime" name="begin" id="begin" class="uk-input">
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-form-label" for="value">{{ __('announcements.to') }}</label>
                    <input type="datetime" name="end" id="end" class="uk-input">
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <button class="uk-button uk-button-default uk-width-1-4 uk-align-left">{{ __('announcements.add') }}</button>
            <button class="uk-button uk-button-default uk-align-right" type="button" uk-toggle="target: .add-content"><span uk-icon="close"></span></button>
        </div>
    </fieldset>

    <input type="hidden" name="screen_id" value="{{ $screen->id }}">
    @csrf
</form>
