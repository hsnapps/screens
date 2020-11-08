@extends('layout')

@push('styles')
<style>
    label,.uk-form-label {
        font-size: 1.25em;
        color: #ffffff !important
    }
    /*
    * Hover
    */
    .uk-table-hover>tr:hover,
    .uk-table-hover tbody tr:hover > td > button,
    .uk-table-hover tbody tr:hover > td > form > button {
        color: #01573F !important;
        /* background: #01573F !important; */
    }

    thead {
        border-bottom-color: #ffd !important;
        border-bottom-style: solid;
        border-bottom-width: thin;
    }

    .user-name {
        float: left;
        margin-top: -25px;
        margin-left: -20px;
        text-align: center;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
@endpush

@section('content')
<div class="uk-grid-collapse uk-child-width-expand uk-margin-medium-bottom" uk-grid>
    <div>
        <a href="{{ route('screens.index') }}" class="uk-button uk-button-text"><span uk-icon="chevron-left"></span> {{ __('screens.title') }}</a>
    </div>
    <div></div>
    <div></div>
</div>

<div class="uk-card uk-card-default uk-card-body">
    @if (isset($screen->user))
    <div class="user-name">{{ $screen->user->name }}<br>{{ $screen->user->section }}</div>
    @endif

    @include('screens._hall')
    @include('screens._times')
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
            @include('screens._snapshot')
        </li>
    </ul>
</div>

<form id="delete-form" action="{{ route('announcements.delete') }}" method="post">
    @method('DELETE')
    @csrf
    <input type="hidden" name="delete_id">
</form>
<form id="update-form" action="{{ route('announcements.update') }}" method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="update_id">
    <input type="hidden" name="update_type">
    <input type="hidden" name="update_text">
</form>
<form id="remove-form" action="{{ route('screens.update-remove', ['screen' => $screen]) }}" method="post">
    @method('DELETE')
    @csrf
    <input type="hidden" name="remove_id">
</form>
@endsection

@push('scripts')
<script src="{{ url('js/jquery-ui.min.js') }}"></script>
<script src="{{ url('js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ url('js/rainbow-custom.min.js') }}"></script>
<script>
    var timer = null;

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
            parentID: 'body',
            weekends: [
                'الجمعة', 'السبت'
            ],
        };

        $.datetimepicker.setLocale('ar');
       	$('.datetimepicker').datetimepicker(datetimepickerOptions);
    });

    $('[name="content"]').change(function() {
        $("#file-name").text($(this).val());
    });

    $('[name="type"]').change(function () {
        $('#content-text').prop('hidden', $(this).val() !== 'text');
        $('#content-file').prop('hidden', $(this).val() === 'text');
    });

    // UIkit.switcher('#screen-tab').show(1);

    $('#snapshot').attr('src', "{{ route('monitor', ['id' => $screen]) }}");

    $('[data-delete]').click(function() {
        var id = $(this).data('delete');
        var index = $(this).data('index');
        var message = 'حذف الإعلان رقم number؟'.replace('number', index);
        $('[name="delete_id"]').val(id);

        UIkit.modal.confirm(message, modalOptions).then(function() {
            $('#delete-form').submit();
        }, function () {});
    });

    $('[data-edit]').click(function() {
        var id = $(this).data('edit');

        $.ajax({
            url: "{{ route('announcements.dialog') }}",
            data: { id: id },
            dataType: 'html',
            success: function(data) {
                UIkit.modal.dialog(data);
            }
        });
    });

    $('[data-remove]').click(function () {
        var id = $(this).data('remove');
        $('[name="remove_id"]').val(id);
        $('#remove-form').submit();
    });
</script>
@endpush
