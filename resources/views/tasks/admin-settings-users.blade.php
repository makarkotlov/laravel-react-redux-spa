<div class="section text-right padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('employee.create') }}" class="btn btn-default">Новый сотрудник</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Отдел</label>
                <select id="dep_select" class="form-control" name="department_id">
                    <option value="0">Все</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul id="users_ul" class="list-group">
                @foreach($users as $user)
                <a href="{{ route('employee.edit', $user->id) }}" class="list-group-item" name="{{ $user->id }}">{{
                    $user->fullname }}</a>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin-settings.js') }}" type="text/javascript"></script>
