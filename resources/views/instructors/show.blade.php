@extends('layout')

@section('content')
<div class="uk-child-width-expand" uk-grid>
    <div></div>
    <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
        <div class="uk-grid-collapse uk-child-width-expand uk-margin-medium-bottom" uk-grid>
            <div>
                <a href="{{ route('instructors.index') }}" class="uk-button uk-button-text"><span uk-icon="chevron-left"></span> {{ __('instructors.title') }}</a>
            </div>
            <div></div>
            <div></div>
        </div>
        <div uk-grid>
            <div class="uk-width-2-3">
                <div class="uk-form-stacked">
                    <div>
                        <label class="uk-form-label">رقم المدرب</label>
                        <div class="uk-form-controls">
                            <input class="uk-input uk-width-1-1" id="form-stacked-text" type="text" readonly value="{{ $instructor->computer_id }}">
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-label">اسم المدرب</div>
                        <div class="uk-form-controls">
                            <input class="uk-input uk-width-1-1" id="form-stacked-text" type="text" readonly value="{{ $instructor->name }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-3">
                @if (isset($instructor->photo))
                <div class="uk-box-shadow-medium uk-padding-remove uk-text-center">
                    <img data-src="{{ url('photos/'.$instructor->photo) }}" width="153" height="153" alt="photo" uk-img>
                </div>
                @else
                <div class="uk-box-shadow-medium uk-padding uk-text-center">
                    <span uk-icon="icon: user; ratio: 5"></span>
                </div>
                @endif
            </div>
        </div>
        <div class="uk-grid-collapse uk-child-width-expand uk-margin-medium-top" uk-grid>
            <div>
                <form id="upload-from" class="uk-width-1-1" method="POST" action="{{ route('instructors.upload') }}" enctype="multipart/form-data" uk-form-custom>
                    @csrf
                    <input type="file" name="photo">
                    <input type="hidden" name="id" value="{{ $instructor->id }}">
                    <button class="uk-button uk-button-default uk-width-1-1" type="button" tabindex="-1">ملف الصورة</button>
                </form>
            </div>
            <div>
                <button id="upload-btn" class="uk-button uk-button-default uk-width-1-1"><span uk-icon="push"></span> حفظ الصورة</button>
            </div>
            <form method="POST" action="{{ route('instructors.remove') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $instructor->id }}">
                <button class="uk-button uk-button-default uk-width-1-1"><span uk-icon="close"></span> حذف الصورة</button>
            </form>
        </div>
        <div>
            <span id="file-name" class="uk-text-center"></span>
        </div>
    </div>
    <div></div>
</div>
@endsection

@push('scripts')
<script>
    $('#upload-btn').click(function() {
        $('#upload-from').submit();
    });

    $('[name="photo"]').change(function() {
        $('#file-name').text($(this).val());
    });
</script>
@endpush
