@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            @include('admin.alert')
            <!-- form start -->
            <form id="frm-action" method="POST" action="">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" value="{{ $menu->name }}" placeholder="Tên danh mục">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="parent_id" class="form-control">
                            <option value="0"
                            {{ $menu->parent_id == 0 ? 'selected' : '' }}>
                                Danh mục cha
                            </option>

                            @foreach ($parent_menu as $item)
                                <option value="{{ $item->id }}" 
                                    {{ $menu->parent_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả chi tiết</label>
                        <textarea name="content" id="content" class="form-control">{{ $menu->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Kích hoạt</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="active" name="active" value="1" {{ $menu->active == 1 ? 'checked' : '' }}>
                            <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="no_active" name="active" value="0" {{ $menu->active == 0 ? 'checked' : '' }}>
                            <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Tạo danh mục</button>
                </div>
            </form>
            </div>
            <!-- /.card -->
            </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'content' );
    </script>
@endsection