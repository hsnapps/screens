@extends('layout')

@push('styles')

@endpush

@section('content')
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-divider uk-table-hover uk-width-1-2">
        <thead>
            <tr>
                <th>#</th>
                <th>رقم المدرب</th>
                <th>المدرب</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Instructor::all() as $instructor)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $instructor->computer_id }}</td>
                <td>{{ $instructor->name }}</td>
                <td><a class="uk-button uk-button-text" href="{{ route('instructors.show', ['computer_id' => $instructor->computer_id]) }}"><span style="color: #174F3F" uk-icon="user"></span></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
@endpush
