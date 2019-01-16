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
            <div class="col-md-12 text-center">
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
        <div class="col-md-12 text-center">
            <a href="{{ route('tasks.create') }}" class="btn btn-lg myBtn">Новая задача</a>
        </div>
    </div>
</div>
<div style="margin-top: 10px;" class="container">
    <div class="row">
            <div class="col-md-12 text-center">
                <form action="{{ action('TaskCompleteController@destroyAllTasks')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button id="task_delete" onclick="return confirm('Удалить все?')" class="btn btn-lg myBtn" type="submit">Удалить все</button>
                </form>
            </div>
        </div>
</div>
@endif



<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <div class="btn-group">
                        <div id="allbutton" class="active btn btn-default">Все</div>
                        <div id="urgentbutton" class="btn btn-default">Срочно</div>
                        <div id="todaybutton" class="btn btn-default">Сегодня</div>
                        <div id="donebutton" class="btn btn-default">Готовые</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div style="margin-left: 6%; width: auto;" id="droptasks" class="container">

    </div>
</div>

<script src="{{ asset('js/index.js') }}" type="text/javascript"></script>

@endsection
