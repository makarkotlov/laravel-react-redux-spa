<div class="section text-right padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="new-department" class="btn btn-default">Новый отдел</div>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    @foreach( $departments as $department)
                    <a class="list-group-item" href="{{ route('DepartmentController.edit', $department->id) }}">{{
                        $department->name }}</a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin-departments.js') }}" type="text/javascript"></script>
