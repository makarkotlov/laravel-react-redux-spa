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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $task->description }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                @if($adminimages->first())
                <div id="{{$i=0}}"></div>
                @foreach($adminimages as $adminimage)
                <div id="{{ $adminimage->id }}" class="col-md-3">
                    <div name="{{$i++}}"></div>
                    <img src="../../{{ $adminimage->file_path }}" class="img-responsive img-rounded">
                    <div id="delete_image{{$i++}}" name="{{ $adminimage->id }}" class="btn btn-block btn-default">Удалить</div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <form role="form" enctype="multipart/form-data" action="{{ route('tasks.update', $task->id) }}"
                        method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label id="dropfilebutton" class="btn btn-default btn-lg">Загрузить фото</label>
                            <div id="dropfileinput"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Описание:</label>
                            <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="text"
                                name="description" value="{{ $task->description }}">
                            @if ($errors->has('description'))
                            <span class="btn-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="radio">
                                @if($task->is_urgent === 1)
                                <label class="radio-inline">
                                    <input type="radio" name="is_urgent" id="optionsRadios1" value="1" checked>Срочно</label>
                                <label class="radio-inline">
                                    <input type="radio" name="is_urgent" id="optionsRadios2" value="0">&nbsp;Сегодня</label>
                                @else
                                <label class="radio-inline">
                                    <input type="radio" name="is_urgent" id="optionsRadios1" value="1">Срочно</label>
                                <label class="radio-inline">
                                    <input type="radio" name="is_urgent" id="optionsRadios2" value="0" checked>&nbsp;Сегодня</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Отдел</label>
                            <select id="dep_select" class="form-control" name="department_id">
                                @foreach($departments as $department)
                                @if($department->name === $task->get_developer->getDepartment->name)
                                <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                @else
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label id="task_id" name="{{ $task->id }}" class="control-label">Сотрудник</label>
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
                            <textarea class="form-control" name="additional_info">{{ $task->additional_info }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-block btn-default btn-lg">Изменить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/task-edit.js') }}" type="text/javascript"></script>
@endsection