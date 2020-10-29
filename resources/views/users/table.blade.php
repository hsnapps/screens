<table class="uk-table uk-table-hover uk-table-divider">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('app.users.name') }}</th>
            <th>{{ __('app.users.username') }}</th>
            <th>{{ __('app.users.created_at') }}</th>
            <th>{{ __('app.users.updated_at') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach (App\User::all() as $user)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>
                <span class="toggle-edit" id="span-name-{{ $user->id }}">{{ $user->name }}</span>
                <span class="toggle-edit" hidden><input id="input-name-{{ $user->id }}" class="uk-input uk-width-1-1" type="text" placeholder="{{ __('app.users.name') }}" value="{{ $user->name }}" maxlength="100"></span>
            </td>
            <td>
                <span class="toggle-edit" id="span-username-{{ $user->id }}">{{ $user->username }}</span>
                <span class="toggle-edit" hidden><input id="input-username-{{ $user->id }}" class="uk-input uk-width-1-1" type="text" placeholder="{{ __('app.users.username') }}" value="{{ $user->username }}" maxlength="15"></span>
            </td>
            <td>{{ $user->created_at->format('H:i Y-m-d') }}</td>
            <td>{{ $user->updated_at->format('H:i Y-m-d') }}</td>
            <td>
                <ul class="uk-iconnav toggle-edit">
                    <li uk-tooltip="{{ __('app.users.edit') }}"><a uk-toggle="target: .toggle-edit" href="#" uk-icon="icon: file-edit; ratio: 1.15"></a></li>
                    <li uk-tooltip="{{ __('app.users.unlock') }}"><a data-unlock="{{ $user->id }}" data-name="{{ $user->name }}" data-route="{{ route('users.update', ['user' => $user]) }}" href="#" uk-icon="icon: unlock; ratio: 1.15"></a></li>
                    <li uk-tooltip="{{ __('app.users.delete') }}"><a data-delete="{{ $user->id }}" data-name="{{ $user->name }}" data-route="{{ route('users.destroy', ['user' => $user]) }}" class="uk-text-danger" href="#" uk-icon="icon: trash; ratio: 1.15"></a></li>
                </ul>

                <ul class="uk-iconnav toggle-edit" hidden>
                    <li class="toggle-update" uk-tooltip="{{ __('app.save') }}"><a data-edit="{{ $user->id }}" data-route="{{ route('users.update', ['user' => $user]) }}" href="#" uk-icon="icon: check; ratio: 1.15"></a></li>
                    <li class="toggle-update" hidden><div uk-spinner="ratio: 0.75"></div></li>
                    <li uk-tooltip="{{ __('app.cancel') }}"><a uk-toggle="target: .toggle-edit" href="#" uk-icon="icon: close; ratio: 1.15"></a></li>
                </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
