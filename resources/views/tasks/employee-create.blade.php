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
    <div>
        <div class="container">
            <div class="row">
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
    <div id="big-container">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <form role="form" action="{{ route('employee.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="last_name" class="control-label">Фамилия</label>
                                <input class="form-control" name="last_name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">Имя</label>
                                <input class="form-control" name="name" type="text">
                            </div>
                            <div class="form-group">
                                <label for="patronymic" class="control-label">Отчество</label>
                                <input class="form-control" name="patronymic" type="text">
                            </div>
                            <div class="form-group">
                                <label for="phone_number" class="control-label">Телефон</label>
                                <input class="form-control" name="phone_number" type="text">
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">E-mail</label>
                                <input class="form-control" name="email" type="text">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input class="form-control" name="password" type="password">
                            </div>
                            <div class="form-group">
                                <label for="department_id" class="control-label">Отдел</label>
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
    </div>
    <script src="{{ asset('js/employee-create.js') }}" type="text/javascript"></script>
@endsection