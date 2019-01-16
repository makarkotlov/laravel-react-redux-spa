@foreach($users as $user)
    <a href="{{ route('employee.edit', $user->id) }}" class="list-group-item" name="{{ $user->id }}">{{ $user->fullname }}</a>
@endforeach
