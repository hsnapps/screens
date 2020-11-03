@extends('layout')

@push('styles')
<style>
    .uk-button {
        color: #ffffff !important;
    }

    /*
    * Hover
    */
    .uk-table-hover > tr:hover,
    .uk-table-hover tbody tr:hover {
        background: #ffd;
    }
</style>
@endpush

@section('content')
@include('shared.validation')

<div uk-grid>
    <div class="uk-form-horizontal">
        <a class="uk-button uk-button-default" href="{{ route('schedules.download') }}"><span uk-icon="cloud-download"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('schedules.download') }}</a>
    </div>
    <form class="uk-form-horizontal" action="{{ route('schedules.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div uk-form-custom>
            <input type="file" name="excel">
            <button class="uk-button uk-button-default" type="button" tabindex="-1">{{ __('schedules.select-file') }}</button>
        </div>
        <button class="uk-button uk-button-secondary uk-margin-small-right"><span uk-icon="cloud-upload"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('schedules.upload') }}</button>
        <button id="file-name" class="uk-button uk-button-text uk-margin-small-right" disabled></button>
    </form>
</div>
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-divider uk-table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>المقرر</th>
                <th>التخصص</th>
                <th>الرقم المرجعي</th>
                <th>نوع الشعبة</th>
                <th>أيام</th>
                <th>أوقات</th>
                <th>قاعة</th>
                <th>المدرب</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $row->subject_code }}</td>
                <td>{{ $row->specialty }}</td>
                <td>{{ $row->reference }}</td>
                <td>{{ $row->classification }}</td>
                <td>{{ __('schedules.days')[$row->day_index] }}</td>
                <td>{{ $row->start->format('H:i').' - '.$row->end->format('H:i') }}</td>
                <td>{{ $row->hall }}</td>
                <td>{{ $row->instructor_name }}</td>
                <td><a class="uk-button uk-button-text" href="{{ route('instructors.show', ['computer_id' => $row->instructor_id]) }}"><span style="color: #174F3F" uk-icon="user"></span></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="uk-text-center">
    {{ $rows->links('shared.pagination') }}
</div>
@endsection

@push('scripts')
<script>
    $('[name="excel"]').change(function() {
        $("#file-name").text($(this).val());
    });
</script>
@endpush
