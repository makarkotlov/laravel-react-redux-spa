@extends('layouts.app')
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
                <div class="col-md-12 text-center">
                    @if ($errors->has('file'))
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first('file') }}</strong>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('failure'))
                    <div class="alert alert-danger">
                        {{ session('failure') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @if(Auth::user()->is_admin === 1)

    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn myBtn">Изменить</a>
            </div>
            <div class="col-md-1">
                <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button id="task_delete" onclick="return confirm('Удалить таск?')" class="btn myBtn" type="submit">Удалить</button>
                </form>
            </div>
        </div>
    </div>

    @endif

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $task->description }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>Создал: {{ $task->created_at }}
                        <br>
                        <br>
                        <b>{{ $task->author->fullname }}&nbsp;</b>(отдел {{ $task->author->getDepartment->name }})
                        <br>
                        <br>
                        <p>тел. {{ $task->author->phone_number }}</p>
                        <br>
                        <br>
                        <br>
                    </p>
                </div>
                <div class="col-md-6">
                    <p>Исполнитель:&nbsp;
                        <br>
                        <br>
                        <b>{{ $task->get_developer->fullname }}</b>&nbsp;(отдел {{
                        $task->get_developer->getDepartment->name }})
                        <br>
                        <br>
                        <p>тел. {{ $task->get_developer->phone_number }}</p>
                        <br>
                        <br>
                        <br>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Дополнительная информация: {{ $task->additional_info }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                @if($adminimages->first())
                @foreach($adminimages as $adminimage)
                <div class="col-md-3">
                    <img src="../../{{ $adminimage->file_path }}" class="img-responsive img-rounded">
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
                    @if(Auth::user()->fullname === $task->get_developer->fullname)

                    <form role="form" enctype="multipart/form-data" action="{{ route('tasks.complete', $task->id) }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="file" class="control-label">Фото</label>
                            <input class="control-label{{ $errors->has('photos[]') ? ' is-invalid' : '' }}" type="file"
                                name="photos[]" multiple accept="image/*" capture="camera">
                            @if ($errors->has('photos[]'))
                            <span class="btn-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('photos[]') }}</strong>
                            </span>
                            @endif
                            <p class="help-block">Без фотографии выполнение задачи невозможно</p>
                        </div>
                        <div class="form-group">
                            <label for="feedback" class="control-label"></label>
                            <input type="text" class="form-control" name="feedback" placeholder="Дополнительная информация">
                        </div>
                        <button type="submit" class="btn btn-block btn-lg btn-success">Сделано</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-default">Сделаю завтра</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <script src="{{ asset('js/task-view.js') }}" type="text/javascript"></script>
@endsection