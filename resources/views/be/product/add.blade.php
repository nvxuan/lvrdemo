@extends('be.layout')
@section('main-content')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data" action="{{route('admin.product.doAdd')}}">
                @csrf
                <div class="card-body">
                    <div class="preview" style="display: flex;">

                    </div>
                    <br>
                    <input type="file" name="img[]" required class="img-select" multiple
                        accept="image/png, image/jpeg, image/gif" onchange="previewImages()">
                    <div class="form-group">

                        <label for="">Name</label>
                        <input type="text" name="name" required class="form-control" placeholder="Enter name"
                            value="{{old('name')}}">
                    </div>
                    <div class="form-group">

                        <label for="">Price</label>
                        <input type="number" name="price" required class="form-control" placeholder="Enter price"
                            value="{{old('price')}}">
                    </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" required class="form-control" placeholder="Quantity"
                            value="{{old('quantity')}}">
                    </div>
                    <div class="form-group">
                        <label for="">Short Desc</label>
                        <textarea name="short_desc" required class="form-control"
                            placeholder="Short Desc">{{old('short_desc')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Tag Line</label>
                        <textarea name="tag_line" required class="form-control"
                            placeholder="Tag Line">{{old('tag_line')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" required class="form-control"
                            placeholder="Content">{{old('content')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Seo Keyword</label>
                        <textarea name="seo_keyword" required class="form-control"
                            placeholder="Seo Keyword">{{old('seo_keyword')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Seo Description</label>
                        <textarea name="seo_description" required class="form-control"
                            placeholder="Seo Description">{{old('seo_description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" required class="form-control">
                            @foreach ($category as $cate)
                            <option value="{{ $cate->id }}">{{ $cate ->name }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Discount</label>
                        <select name="discount_id" class="form-control">
                            <option value="0">0</option>
                            @foreach ($discount as $dis)
                            <option value="{{ $dis->id }}">{{ $dis ->amount }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Variant</label>
                        @foreach ($variants as $variant)
                        @if (count($variant->variantValues)>0)

                        <label>{{ $variant->name }}</label>
                        @foreach ($variant->variantValues as $variantValue)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="variants[]"
                                value="{{ $variant->id }}|{{ $variant->name }}|{{ $variantValue->id }}">
                            <label class="form-check-label" for="examplecheck1">{{ $variantValue->name }}</label>
                        </div>
                        @endforeach
                        @endif
                        @endforeach
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
<script>
    async function previewImages() {
        for(let i = 0; i < document.querySelector('.img-select').files.length; i++){
            const reader = new FileReader();
            await reader.readAsDataURL(document.querySelector('.img-select').files[i]);

            reader.onload = function (file){
                const preview = document.querySelector('.preview');
                const img = document.createElement('img');
                img.setAttribute('src', file.target.result);
                img.classList.add('thumb');
                preview.appendChild(img);
            }
        }
    }
    CKEDITOR.replace( 'content' );
</script>
<style>
    .thumb {
        width: 100px;
        height: 80px;
        object-font: cover;
    }
</style>
@endsection