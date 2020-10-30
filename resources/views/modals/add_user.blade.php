<form id="add-user" action="{{ route('users.store') }}" method="POST" uk-modal>
    @csrf
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">{{ __('users.add-user') }}</h2>
        </div>
        <div class="uk-modal-body" class="uk-form-stacked">
             <div class="uk-margin">
                <label class="uk-form-label" for="name">{{ __('users.name') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="name" type="text" placeholder="{{ __('users.name') }}" maxlength="100">
                </div>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="username">{{ __('users.username') }}</label>
                <div class="uk-form-controls">
                    <input class="uk-input" name="username" type="text" placeholder="{{ __('users.username') }}" maxlength="15">
                </div>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-left">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
            <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
        </div>
    </div>
</form>
