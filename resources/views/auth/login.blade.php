@extends('layouts.app')

@section('content')
<div class="uk-width-medium uk-padding-small">
    <!-- login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <fieldset class="uk-fieldset">
            <div class="uk-margin-small">
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: user"></span>
                    <input class="uk-input uk-border-pill" name="username" required placeholder="{{ __('auth.username') }}" type="text">
                </div>

                @error('username')
                <div class="uk-text-center">
                    <span class="uk-text-danger">
                        <span class="uk-label uk-label-danger">{{ $message }}</span>
                    </span>
                </div>
                @enderror
            </div>

            <div class="uk-margin-small">
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" data-uk-icon="icon: lock"></span>
                    <input class="uk-input uk-border-pill" name="password" required placeholder="{{ __('auth.password') }}" type="password">
                </div>

                @error('password')
                <div class="uk-text-center">
                    <span class="uk-text-danger">
                        <span class="uk-label uk-label-danger">{{ $message }}</span>
                    </span>
                </div>
                @enderror
            </div>

            <div class="uk-margin-small">
                <label><input class="uk-checkbox" type="checkbox"> &nbsp; {{ __('auth.remember') }}</label>
            </div>
            <div class="uk-margin-bottom">
                <button type="submit" class="uk-button uk-button-green uk-border-pill uk-width-1-1">{{ __('auth.login') }}</button>
            </div>
        </fieldset>
    </form>
    <!-- /login -->
</div>
@endsection
