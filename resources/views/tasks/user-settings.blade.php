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

                    <form role="form" action="{{ route('employee.update', Auth::user()->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="control-label" for="exampleInputEmail1">Фамилия</label>
                            <input class="form-control" name="last_name" type="text" value="{{ Auth::user()->last_name }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Имя</label>
                            <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Отчество</label>
                            <input class="form-control" name="patronymic" type="text" value="{{ Auth::user()->patronymic }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Телефон</label>
                            <input class="form-control" name="phone_number" type="text" value="{{ Auth::user()->phone_number }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">E-mail</label>
                            <input class="form-control" name="email" type="text" disabled="disabled" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Отдел</label>
                            <input class="form-control" name="department" type="text" disabled="disabled" value="{{ Auth::user()->getDepartment->name }}">
                        </div>
                        <button type="submit" class="btn btn-block btn-default">Сохранить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection