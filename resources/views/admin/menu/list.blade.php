@extends('admin.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        
        @include('admin.alert')

        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px">ID</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                {!! Helper::menu($menus) !!}
            </tbody>
        </table>
    </div><!-- /.container-fluid -->
</section>
@endsection