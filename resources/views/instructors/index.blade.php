@extends('layout')

@push('styles')
<style>
    .uk-button {
        color: #ffffff !important;
    }
    .uk-table > tr > td > a {
        color: #01573F !important;
        border: none !important;
        background-color: transparent !important;
    }
    .uk-table > tr:nth-last-of-type(even) > td > a {
        color: #f8f8f8 !important;
    }
    /*
    * Striped
    */
    .uk-table-striped > tr:nth-of-type(odd),
    .uk-table-striped tbody tr:nth-of-type(odd) {
        background: #f8f8f8;
        border-top: 1px solid #e5e5e5;
        border-bottom: 1px solid #e5e5e5;
        color: #01573F !important;
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
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-striped uk-table-divider uk-table-hover">
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
                <td><a href="{{ route('instructors.show', ['computer_id' => $instructor->computer_id]) }}"><span uk-icon="user"></span></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
@endpush
