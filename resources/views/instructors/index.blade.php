@extends('layout')

@push('styles')

@endpush

@section('content')
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-divider uk-table-hover uk-width-1-1">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('instructors.id') }}</th>
                <th>{{ __('instructors.name') }}</th>
                <th>{{ __('instructors.phone') }}</th>
                <th>{{ __('instructors.email') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instructors as $instructor)
            <tr>
                {{-- <td>{{ ( $loop->index + 1) + ($instructors->count()) }}</td> --}}
                <td>{{ ($loop->index + 1) + ($instructors->perPage() * ($instructors->currentPage() - 1) ) }}</td>
                <td>{{ $instructor->computer_id }}</td>
                <td>{{ $instructor->name }}</td>
                <td>{{ $instructor->phone }}</td>
                <td>{{ $instructor->email }}</td>
                <td>
                    <a class="uk-button uk-button-text" href="{{ route('instructors.show', ['computer_id' => $instructor->computer_id]) }}"><span style="color: #174F3F" uk-icon="user"></span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="uk-text-center">
    {{ $instructors->links('shared.pagination') }}
</div>
@endsection

@push('scripts')
@endpush
