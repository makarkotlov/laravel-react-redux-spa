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
                    <h1>Новая задача</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <form id="myForm" enctype="multipart/form-data" role="form" action="{{ route('tasks.store') }}"
                        method="post">
                        @csrf

                        <div class="form-group">
                            <label id="dropfilebutton" class="btn btn-default btn-lg">Загрузить фото</label>
                            <div id="dropfileinput"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Описание:</label>
                            <input id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                value="{{ old('description') }}" type="text" name="description">
                            @if ($errors->has('description'))
                            <span class="btn-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                <label class="radio-inline">
                                    <input type="radio" name="is_urgent" id="optionsRadios1" value="1" checked="">Срочно</label>
                                <label class="radio-inline">
                                    <input type="radio" name="is_urgent" id="optionsRadios2" value="0" checked="">&nbsp;Сегодня</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Отдел</label>
                            <select id="dep_select" class="form-control" name="department_id">
                                <option value="0">Выберите</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Сотрудник</label>
                            <select id="user_select" class="form-control{{ $errors->has('developer_id') ? ' is-invalid' : '' }}"
                                name="developer_id"></select>
                            @if ($errors->has('developer_id'))
                            <span class="btn-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('developer_id') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="control-label">Дополнительная информация</label>
                            <textarea id="additional_info" class="form-control{{ $errors->has('additional_info') ? ' is-invalid' : '' }}"
                                value="{{ old('additional_info') }}" name="additional_info"></textarea>
                            @if ($errors->has('additional_info'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('additional_info') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button id="submit" type="submit" class="btn btn-block btn-default btn-lg">Добавить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/task-create.js') }}" type="text/javascript"></script>
@endsection