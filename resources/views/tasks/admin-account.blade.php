<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <form role="form" action="{{ route('employee.superupdate', $admin->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label class="control-label">Фамилия</label>
                        <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name"
                            type="text" value="{{ $admin->last_name }}">
                        @if ($errors->has('last_name'))
                        <span class="btn-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Имя</label>
                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text"
                            value="{{ $admin->name }}">
                        @if ($errors->has('name'))
                        <span class="btn-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Отчество</label>
                        <input class="form-control{{ $errors->has('patronymic') ? ' is-invalid' : '' }}" name="patronymic"
                            type="text" value="{{ $admin->patronymic }}">
                        @if ($errors->has('patronymic'))
                        <span class="btn-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('patronymic') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Телефон</label>
                        <input class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number"
                            type="text" value="{{ $admin->phone_number }}">
                        @if ($errors->has('phone_number'))
                        <span class="btn-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text"
                            value="{{ $admin->email }}">
                        @if ($errors->has('email'))
                        <span class="btn-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Отдел</label>
                        <select name="department_id" class="form-control">
                            @foreach( $departments as $department)
                            @if( $department->id === $admin->department_id )
                            <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                            @else
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-block btn-default">Сохранить</button>
                </form>


            </div>
        </div>
    </div>
</div>
