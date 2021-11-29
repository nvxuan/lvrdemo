@extends('be.layout')
@section('main-content')
<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
        </div>
        <form method="post" action="{{ route('admin.oder.doedit', ['id'=>$obj->id]) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Địa Chỉ</label>
                    <input name="address" type="text" class="form-control" value="{{ $obj->address}}">
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option <?php if ($obj->status==1) {echo 'selected = "selected"';} ?> value="1">Đang chờ giao
                        </option>
                        <option <?php if ($obj->status==2) {echo 'selected = "selected"';} ?> value="2">Đang giao
                        </option>
                        <option <?php if ($obj->status==3) {echo 'selected = "selected"';} ?> value="3">Đã Thanh toán
                        </option>
                        <option <?php if ($obj->status==4) {echo 'selected = "selected"';} ?> value="4">Đã Hủy
                        </option>
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