<table class="uk-table uk-table-hover uk-table-divider">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('users.name') }}</th>
            <th>{{ __('users.username') }}</th>
            <th>{{ __('users.is_admin') }}</th>
            <th>{{ __('users.section') }}</th>
            <th>{{ __('users.created_at') }}</th>
            <th>{{ __('users.updated_at') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach (App\User::all() as $user)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{!! $user->is_admin ? '<span uk-icon="check"></span>' : '<span uk-icon="close"></span>' !!}</td>
            <td>{{ $user->section }}</td>

            <td>{{ $user->created_at->format('H:i Y-m-d') }}</td>
            <td>{{ $user->updated_at->format('H:i Y-m-d') }}</td>
            <td>
                <ul class="uk-iconnav">
                    @if (Auth::user()->is_admin)
                    <li uk-tooltip="{{ __('users.edit') }}"><a href="#edit-{{ $user->id }}" uk-toggle uk-icon="icon: file-edit; ratio: 1.15"></a></li>
                    @endif

                    @if (!$user->is_admin)
                    <li uk-tooltip="{{ __('users.screens') }}"><a href="#screens-{{ $user->id }}" uk-toggle uk-icon="icon: thumbnails; ratio: 1.15"></a></li>
                    @endif

                    <li uk-tooltip="{{ __('users.unlock') }}"><a data-unlock="{{ $user->id }}" data-name="{{ $user->name }}" data-route="{{ route('users.edit', ['user' => $user]) }}" href="#" uk-icon="icon: unlock; ratio: 1.15"></a></li>
                    <li uk-tooltip="{{ __('users.delete') }}"><a data-delete="{{ $user->id }}" data-name="{{ $user->name }}" data-route="{{ route('users.destroy', ['user' => $user]) }}" class="uk-text-danger" href="#" uk-icon="icon: trash; ratio: 1.15"></a></li>
                </ul>

                @include('modals.edit_user')
                @include('modals.screens')
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
