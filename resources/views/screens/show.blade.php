@extends('layout')

@push('styles')
@endpush

@section('content')
<div class="uk-card uk-card-default uk-card-body">
    <form class="uk-grid-collapse" action="{{ route('screens.update', ['screen' => $screen]) }}" method="POST" uk-grid>
        @csrf
        <div>
            <label class="uk-form-label uk-padding-small uk-margin-small-top uk-text-large">{{ __('screens.hall') }}</label>
        </div>
        <div>
            <div class="uk-form-controls">
                <input class="uk-input uk-width-1-1" type="text" name="hall" value="{{ $screen->hall }}" placeholder="{{ __('screens.hall') }}">
            </div>
        </div>
        <div>
            <button class="uk-button uk-button-secondary uk-input uk-width-1-1">{{ __('screens.update') }}</button>
        </div>
    </form>
</div>

<div class="uk-padding">
    <ul class="uk-subnav uk-subnav-pill" uk-switcher>
        <li><a href="#">{{ __('screens.lectures') }}</a></li>
        <li><a href="#">{{ __('screens.announcements') }}</a></li>
    </ul>

    <ul class="uk-switcher uk-margin">
        <li>
            <div class="uk-card uk-card-header">
                <div class="uk-card-body uk-padding-remove">
                    <div class="uk-overflow-auto">
                        <table class="uk-table uk-table-striped uk-table-divider uk-table-hover">
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
                                @foreach ($lectures as $row)
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
                                    <td><a href="{{ route('instructors.show', ['computer_id' => $row->instructor_id]) }}"><span uk-icon="user"></span></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </li>
        <li>Hello again!</li>
    </ul>
</div>


@endsection

@push('scripts')
@endpush
