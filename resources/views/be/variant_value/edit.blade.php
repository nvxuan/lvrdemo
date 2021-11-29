@extends('be.layout')
@section('main-content')
<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
        </div>
        <form method="post" action="{{ route('admin.variant_value.doedit', ['id'=>$obj->id]) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Variant Name</label>
                    <input name="name" type="text" class="form-control" value="{{ $obj->name}}">
                </div>
                <div class="form-group">
                    <label>Variant</label>
                    <select name="variant_id" class="form-control">
                        @foreach ($variants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant ->name }}</option>

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