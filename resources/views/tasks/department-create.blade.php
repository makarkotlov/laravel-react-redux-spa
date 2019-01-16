<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form role="form" action="{{ route('DepartmentController.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="department_name" class="control-label">Название отдела</label>
                        <input name="department_name" class="form-control{{ $errors->has('department_name') ? ' is-invalid' : '' }}"
                            type="text">
                        @if ($errors->has('department_name'))
                        <span class="btn-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('department_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-block btn-default">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>
