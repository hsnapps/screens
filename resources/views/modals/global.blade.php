<div class="uk-card uk-margin-medium-bottom uk-text-center uk-padding-remove">
    <button class="uk-button uk-button-default uk-margin-small-right uk-text-large uk-width-1-2 uk-padding" type="button">
        {{ $button }}
    </button>

    <div class="uk-card-body">

    </div>
</div>

<form class="uk-card uk-margin-medium-bottom uk-text-center uk-padding-remove" action="{{ route('announcements.global') }}" method="POST">
    @csrf

    <div class="uk-card-body uk-form-stacked">
        <div class="uk-margin">
            <label class="uk-form-label" for="begin">{{ __('screens.from') }}</label>
            <div class="uk-form-controls">
                <input type="text" name="content_start" id="begin" class="uk-input datetimepicker" autocomplete="off" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="end">{{ __('screens.to') }}</label>
            <div class="uk-form-controls">
                <input type="text" name="content_end" id="end" class="uk-input datetimepicker" autocomplete="off" required>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="text">{{ __('screens.announcement_text') }}</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea" name="text" rows="5" placeholder="{{ __('screens.announcement_text') }}" required></textarea>
            </div>
        </div>
    </div>

    <div class="uk-text-left">
        <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
        <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
    </div>
</form>
