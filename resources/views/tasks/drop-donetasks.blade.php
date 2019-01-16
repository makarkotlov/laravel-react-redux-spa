<div name="{{ $i=0 }}"></div>
@if(Auth::user()->is_admin === 1)
@foreach($tasks as $task)
@if($task->is_done === 1)
@if($i === 0)
<div class="row">
    <div name="{{ $i++ }}" class="col-md-3 task-item">
        <a href="{{ route('tasks.show', $task->id)}}">
            @if($task->get_image->first())
            <img src="{{ $task->get_image->first()->file_path }}" class="img-responsive img-rounded">
            @else
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                class="img-responsive img-rounded">
            @endif
            <h3>{{ $task->description }}</h3>
        </a>
    </div>
    @else
    @if($i%4===0)
</div>
<div class="row">
    <div name="{{ $i++ }}" class="col-md-3 task-item">
        <a href="{{ route('tasks.show', $task->id)}}">
            @if($task->get_image->first())
            <img src="{{ $task->get_image->first()->file_path }}" class="img-responsive img-rounded">
            @else
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                class="img-responsive img-rounded">
            @endif
            <h3>{{ $task->description }}</h3>
        </a>
    </div>
    @else
    <div name="{{ $i++ }}" class="col-md-3 task-item">
        <a href="{{ route('tasks.show', $task->id)}}">
            @if($task->get_image->first())
            <img src="{{ $task->get_image->first()->file_path }}" class="img-responsive img-rounded">
            @else
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                class="img-responsive img-rounded">
            @endif
            <h3>{{ $task->description }}</h3>
        </a>
    </div>
    @endif
    @endif
    @endif
    @endforeach
    @else
    @foreach($tasks->where('developer_id', Auth::user()->id) as $task)
    @if($task->is_done === 1)
    @if($i === 0)
    <div class="row">
        <div name="{{ $i++ }}" class="col-md-3 task-item">
            <a href="{{ route('tasks.show', $task->id)}}">
                @if($task->get_image->first())
                <img src="{{ $task->get_image->first()->file_path }}" class="img-responsive img-rounded">
                @else
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                    class="img-responsive img-rounded">
                @endif
                <h3>{{ $task->description }}</h3>
            </a>
        </div>
        @else
        @if($i%4===0)
    </div>
    <div class="row">
        <div name="{{ $i++ }}" class="col-md-3 task-item">
            <a href="{{ route('tasks.show', $task->id)}}">
                @if($task->get_image->first())
                <img src="{{ $task->get_image->first()->file_path }}" class="img-responsive img-rounded">
                @else
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                    class="img-responsive img-rounded">
                @endif
                <h3>{{ $task->description }}</h3>
            </a>
        </div>
        @else
        <div name="{{ $i++ }}" class="col-md-3 task-item">
            <a href="{{ route('tasks.show', $task->id)}}">
                @if($task->get_image->first())
                <img src="{{ $task->get_image->first()->file_path }}" class="img-responsive img-rounded">
                @else
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png"
                    class="img-responsive img-rounded">
                @endif
                <h3>{{ $task->description }}</h3>
            </a>
        </div>
        @endif
        @endif
        @endif
        @endforeach
        @endif
        <script src="{{ asset('js/fadein.js') }}" type="text/javascript"></script>
