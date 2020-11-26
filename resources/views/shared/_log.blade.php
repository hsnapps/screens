<div class="uk-card uk-card-header">
    <div class="uk-card-body uk-padding-remove">
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-divider uk-table-hover uk-padding-remove">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                        <th>البيان</th>

                        @if (Route::currentRouteName() == 'users.log')
                        <th>رقم الشاشة</th>
                        <th>رقم القاعة</th>
                        @endif

                        @if (Route::currentRouteName() != 'users.log')
                        <th>المستخدم</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $log->created_at->format('Y-m-d') }}</td>
                        <td>{{ $log->created_at->format('H:i') }}</td>
                        <td>{{ $log->message }}</td>

                        @if (Route::currentRouteName() == 'users.log')
                        <td>{{ isset($log->screen) ? $log->screen->id : '' }}</td>
                        <td>{{ isset($log->screen) ? $log->screen->hall : '' }}</td>
                        @endif

                        @if (Route::currentRouteName() != 'users.log')
                        <td>{{ $log->user->name }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
