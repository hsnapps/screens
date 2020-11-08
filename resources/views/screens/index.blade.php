@extends('layout')

@push('styles')
<style>
    .uk-padding { padding: 30px !important; }
    .uk-width-1-6 { font-family: 'Courier New', Courier, monospace; }
</style>
@endpush

@section('content')
<div class="uk-card uk-card-default uk-width-1-2@m">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
                <img class="uk-border-circle" width="40" height="40" src="images/avatar.jpg">
            </div>
            <div class="uk-width-expand">
                <h3 class="uk-card-title uk-margin-remove-bottom">Title</h3>
                <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">April 01, 2016</time></p>
            </div>
        </div>
    </div>
    <div class="uk-card-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
    </div>
    <div class="uk-card-footer">
        <a href="#" class="uk-button uk-button-text">Read more</a>
    </div>
</div>

@php
    $i = 0;
@endphp

@while ($i < App\Screen::count())
    <div class="uk-child-width-expand@s uk-text-center uk-text-large button" uk-grid>
        @foreach (App\Screen::all()->skip($i)->take(5) as $screen)

        @php
            $add_link = false;
            if (Auth::user()->is_admin) {
                $add_link = true;
            } else {
                if (isset($screen->user)) {
                    if ($screen->user->id == Auth::user()->id) {
                        $add_link = true;
                    }
                }
            }
        @endphp

        <div class="uk-width-1-5" data-link="{{ $add_link ? route('screens.show', ['screen' => $screen]) : null }}" style="z-index: inherit">
            @if (isset($screen->hall))
                <div class="uk-card uk-card-default uk-card-body{{ isset($screen->user) ? ' background-selected' : '' }}">
                    {{ $screen->id }}<br>{{ $screen->hall }}<br><span class="uk-text-small">{!! isset($screen->user) ? $screen->user->name : '&nbsp;&nbsp;' !!}</span>
                </div>
            @else
                <div class="uk-card uk-card-body uk-background-muted{{ isset($screen->user) ? ' background-selected' : '' }}">
                    {{ $screen->id }}<br>{{ __('screens.free') }}<br><span class="uk-text-small">{!! isset($screen->user) ? $screen->user->name : '&nbsp;&nbsp;' !!}</span>
                </div>
            @endif
        </div>
        @endforeach
    </div>

    @php
        $i += 6;
    @endphp
@endwhile

@endsection

@push('scripts')
<script src="{{ url('js/jquery-ui.min.js') }}"></script>
<script src="{{ url('js/jquery.datetimepicker.full.js') }}"></script>
<script src="{{ url('js/rainbow-custom.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var datetimepickerOptions = {
            format: 'H:i Y-m-d',
            i18n: {
                ar: {
                    months: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمير', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
                    dayOfWeekShort: ['ن', 'ث', 'ع', 'خ', 'ج', 'س', 'ح'],
                    dayOfWeek: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد']
                }
            },
            rtl: true,
            hours12: true,
            weekends: [
                'الجمعة', 'السبت'
            ],
        };

        $.datetimepicker.setLocale('ar');
       	$('.datetimepicker').datetimepicker(datetimepickerOptions);
    });
</script>
@endpush
