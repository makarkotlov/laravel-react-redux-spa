@foreach($users as $user)
    @if($user->is_admin === 0)
        @if($user->id === $task->developer_id)
            <option value="{{ $user->id }}" selected>{{ $user->fullname }}</option>
        @else
                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
        @endif
    @endif
@endforeach