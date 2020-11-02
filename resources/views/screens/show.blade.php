@extends('layout')

@push('styles')
<style>
    label,.uk-form-label {
        font-size: 1.25em;
        color: #ffffff !important
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
@endpush

@section('content')
<div class="uk-card uk-card-default uk-card-body">
    @include('screens._hall')
</div>

<div class="uk-padding">
    <ul id="screen-tab" class="uk-subnav uk-subnav-pill" uk-switcher>
        <li><a href="#">{{ __('screens.lectures') }}</a></li>
        <li><a href="#">{{ __('screens.announcements') }}</a></li>
        <li><a href="#">{{ __('screens.snapshot') }}</a></li>
    </ul>

    <ul id="switcher-content" class="uk-switcher uk-margin">
        <li id="_lectures">
            @include('screens._lectures')
        </li>
        <li id="_announcements">
            @include('screens._announcements')
        </li>
        <li id="_snapshot">
            @if (isset($screen->snapshot))
            <img data-src="{{ url('snapshots/'.$screen->snapshot) }}" width="800" alt="" uk-img>
            @else

            @endif
        </li>
    </ul>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<script src="http://cdn.craig.is/js/rainbow-custom.min.js"></script>
<script>
    var timer = null;

    $(document).ready(function() {
        var options = { format: 'H:i Y-m-d' };
        $.datetimepicker.setLocale('ar-SA');
       	$('#begin').datetimepicker(options);
       	$('#end').datetimepicker(options);
    });

    $('[name="content"]').change(function() {
        $("#file-name").text($(this).val());
    });

    $('[name="type"]').change(function () {
        $('#content-text').prop('hidden', $(this).val() !== 'text');
        $('#content-file').prop('hidden', $(this).val() === 'text');
    });

    UIkit.switcher('#screen-tab').show(1);

    UIkit.util.on('#switcher-content', 'shown', function (e) {
        if (e.target.id === '_snapshot') {
            timer = setInterval(function() {

            }, 1000 * 30);
        } else {
            clearTimeout(timer);
        }
    });
</script>
@endpush
