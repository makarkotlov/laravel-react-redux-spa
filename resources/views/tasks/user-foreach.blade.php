@foreach($users as $user)
    @if($user->is_admin === 0)
        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
    @endif
@endforeach