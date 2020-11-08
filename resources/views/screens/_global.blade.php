<div class="uk-card uk-margin-medium-bottom uk-text-center uk-padding global">
    <button class="uk-button uk-button-default uk-margin-small-right uk-text-large uk-width-1-2 uk-padding" type="button" uk-toggle="target: .global; animation: uk-animation-fade">{{ $button }}</button>
</div>

<form id="global" action="{{ route('announcements.global') }}" method="POST" class="uk-card uk-card-default uk-width-1-1 uk-margin-medium-bottom uk-box-shadow-large global" hidden>
    <div class="uk-card-header">
        {{ $button }}
        <button type="button" class="uk-close-large uk-align-left" uk-toggle="target: .global; animation: uk-animation-fade" uk-close></button>
    </div>

    <div class="uk-card-body uk-form-stacked">
        <div uk-grid>
            <div class="uk-width-expand">
                <div class="uk-margin">
                    <label class="uk-form-label" for="begin">{{ __('screens.from') }}</label>
                    <div class="uk-form-controls">
                        <input type="text" name="content_start" id="begin" class="uk-input datetimepicker" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <div class="uk-width-expand">
                <div class="uk-margin">
                    <label class="uk-form-label" for="end">{{ __('screens.to') }}</label>
                    <div class="uk-form-controls">
                        <input type="text" name="content_end" id="end" class="uk-input datetimepicker" autocomplete="off" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-margin">
            <label class="uk-form-label" for="text">{{ __('screens.announcement_text') }}</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea" id="announcement_text" name="text" rows="5" placeholder="{{ __('screens.announcement_text') }}" required></textarea>
            </div>
        </div>
    </div>

    @csrf
    <div class="uk-card-footer uk-text-left">
        <button class="uk-button uk-button-default uk-modal-close" type="button" uk-toggle="target: .global; animation: uk-animation-fade">{{ __('app.cancel') }}</button>
        <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
    </div>
</form>
