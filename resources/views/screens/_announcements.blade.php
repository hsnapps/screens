<div class="uk-card uk-card-header">
    <div class="uk-card-body uk-padding-remove">
        <div class="uk-overflow-auto">
            <button class="uk-button uk-button-default add-content" type="button" uk-toggle="target: .add-content">{{ __('announcements.add') }}</button>
            @include('screens._add')
        </div>
    </div>
</div>

<div class="uk-margin-top-remove">
    <table class="uk-table uk-table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('announcements.type') }}</th>
                <th class="uk-text-truncate">{{ __('announcements.value') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.edit') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.is_active') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.view') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.trash') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screen->announcements as $announcement)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ __('announcements.types')[$announcement->type] }}</td>
                <td>{{ $announcement->type == 'text' ? $announcement->value : '' }}</td>
                <td>
                    <button class="uk-button uk-button-text" data-edit="{{ $announcement->id }}" data-text="{{ $announcement->value }}" data-type="{{ $announcement->type }}" type="button"><span uk-icon="pencil"></span></button>
                </td>
                <td>
                    <form action="{{ route('announcements.change-active') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $announcement->id }}">
                        <button class="uk-button uk-button-text"><span uk-icon="{{ $announcement->is_active ? 'check' : 'close' }}"></span></button>
                    </form>
                </td>
                <td>
                    <button class="uk-button uk-button-text" uk-toggle="target: #modal-{{ $announcement->id }}"><span uk-icon="icon: search"></span></button>
                    @include('screens._announcement_modal')
                </td>
                <td>
                    <button class="uk-button uk-button-text" data-delete="{{ $announcement->id }}" data-index="{{ $loop->index + 1 }}" type="button"><span uk-icon="trash"></span></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
