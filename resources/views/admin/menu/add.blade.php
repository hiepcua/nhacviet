@extends('admin.main')

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
            <!-- form start -->
            <form id="frm-action" method="POST" action="">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="parent_id" class="form-control">
                            <option value="0">Danh mục cha</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả chi tiết</label>
                        <textarea name="content" class="form-control"></textarea>
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