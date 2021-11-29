@extends('be.layout')
@section('main-content')
<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
        </div>
        <form method="post" action="{{ route('admin.category.doedit', ['id'=>$obj->id]) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input name="name" type="text" class="form-control" value="{{ $obj->name}}">
                </div>
                <div class="form-group">
                    <label>Parent Category</label>
                    <select name="parent_id" class="form-control">
                        <option <?php if ($obj->parent_id==0) {echo 'selected = "selected"';} ?> value="0">No Parent
                        </option>
                        @foreach ($category as $cate)
                        <option <?php if ($obj->parent_id==$cate->id) {echo 'selected = "selected"';} ?>
                            value="{{ $cate->id }}">
                            {{ $cate ->name }}</option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection