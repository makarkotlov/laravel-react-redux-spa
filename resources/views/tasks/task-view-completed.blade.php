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
    @if(Auth::user()->is_admin === 1)

    <div class="container">
        <div class="row">
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
                        <b>{{ $task->author->fullname }}</b>(отдел {{ $task->author->getDepartment->name }})
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
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Выполнено: {{ $task->updated_at }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Отзыв: {{ $task->feedback }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">

                @if($userimages->first()->file_path)
                @foreach($userimages as $userimage)
                <div class="col-md-3">
                    <img src="../../{{ $userimage->file_path }}" class="img-responsive img-rounded">
                </div>
                @endforeach
                @else
                <div class="col-md-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                        class="img-responsive img-rounded">
                </div>
                @endif
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Задание: {{ $task->description }}</h2>
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
                @else
                <div class="col-md-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                        class="img-responsive img-rounded">
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection