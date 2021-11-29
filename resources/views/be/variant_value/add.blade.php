@extends('be.layout')
@section('main-content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Add Variant Value</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div>
                <form method="post" action="{{route('admin.variant_value.doAdd')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Variant Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name"
                                value="{{old('name')}}">
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
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection