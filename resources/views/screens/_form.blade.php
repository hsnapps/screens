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

<div class="content-text uk-margin">
    <label class="uk-form-label" for="value">{{ __('announcements.value') }}</label>
    <textarea name="text" class="uk-textarea" rows="3" placeholder="{{ __('announcements.value') }}"></textarea>
</div>

<div class="content-text" uk-grid>
    <div class="uk-width-1-2">
        <label class="uk-form-label uk-padding-small" style="color: #26473C !important">{{ __('screens.from') }}</label>
        <div class="uk-form-controls">
            <input type="text" name="content_start" id="begin" class="uk-input datetimepicker" autocomplete="off" value="{{ isset($screen->content_start) ? $screen->content_start->format('Y/m/d h:i') : '' }}">
        </div>
    </div>

    <div class="uk-width-1-2">
        <label class="uk-form-label uk-padding-small" style="color: #26473C !important">{{ __('screens.to') }}</label>
        <div class="uk-form-controls">
            <input type="text" name="content_end" id="end" class="uk-input datetimepicker" autocomplete="off" value="{{ isset($screen->content_end) ? $screen->content_end->format('Y/m/d h:i') : '' }}">
        </div>
    </div>
</div>

<div id="content-file" class="uk-margin" hidden>
    <label class="uk-form-label" for="value">{{ __('announcements.value') }}</label>
    <div uk-form-custom>
        <input type="file" name="content">
        <button class="uk-button uk-button-secondary" type="button" tabindex="-1">{{ __('schedules.select-file') }}</button>
    </div>
    <span id="file-name" class="uk-margin-small-right uk-text-secondary" disabled></span>
</div>

<input type="hidden" name="screen_id" value="{{ $screen_id }}">
@csrf


