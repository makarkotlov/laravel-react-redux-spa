@extends('layouts.app')
@section('myscript')
    <script type="text/javascript">
        window.Laravel = {!!json_encode([
                'user' => auth() -> check() ? auth() -> user() -> id : null,
            ]) !!};
    </script>
@endsection
@section('divnav')
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a href="{{ route('tasks.index') }}">Мои задачи<span class="badge">{{ $tasks->where('is_done', 0)->count()
                    }}</span></a>
        </li>
        @if(Auth::user()->is_admin === 1)
        <li>
            <a href="{{ route('tasks.admin_settings') }}">Админка</a>
        </li>
        @else
        <li>
            <a href="/account">Настройки</a>
        </li>
        @endif
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li>
            @if(Auth::user()->is_admin === 1)
            <a class="nav-link dropdown-toggle" href="/account">
                {{ Auth::user()->name }}
            </a>
            @else
            <a class="nav-link dropdown-toggle" href="/account">
                {{ Auth::user()->name }}
            </a>
            @endif
        </li>
        <li>
            <a class="nav-link dropdown-toggle" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>

</div><!-- /.navbar-collapse -->
@endsection
@section('content')
    <div class="section">

    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 text-center">
                        <div class="btn-group">
                            <div id="users" class="active btn btn-default">Сотрудники</div>
                            <div id="departments" class=" btn btn-default">Отделы</div>
                            <div id="account" class="btn btn-default">Аккаунт</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="big-container">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <form role="form" action="{{ route('employee.superupdate', $user->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label class="control-label">Фамилия</label>
                                <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name"
                                    type="text" value="{{ $user->last_name }}">
                                @if ($errors->has('last_name'))
                                <span class="btn-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Имя</label>
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                    type="text" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                <span class="btn-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Отчество</label>
                                <input class="form-control{{ $errors->has('patronymic') ? ' is-invalid' : '' }}" name="patronymic"
                                    type="text" value="{{ $user->patronymic }}">
                                @if ($errors->has('patronymic'))
                                <span class="btn-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('patronymic') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Телефон</label>
                                <input class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number"
                                    type="text" value="{{ $user->phone_number }}">
                                @if ($errors->has('phone_number'))
                                <span class="btn-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">E-mail</label>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    type="text" value="{{ $user->email }}">
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
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-block btn-default">Сохранить</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('employee.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Удалить сотрудника?')" class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{ asset('js/user-edit.js') }}"></script>
@endsection