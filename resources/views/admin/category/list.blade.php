@extends('layout.admin.default')
@section('main')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 mb-5">Danh sách danh mục</h1>
    @if(session('messageError'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div>
        {{ session('messageError') }}
        </div>
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-secondary btn-sm" onclick="">Chọn tất cả</button>
            <button type="button" class="btn btn-secondary btn-sm" onclick="">Bỏ chọn tất cả</button>
            <button type="submit" name="xoacacmucchon" class="btn btn-secondary btn-sm">Xóa các mục đã chọn</button>
            <a href="{{ route('admin.categories.addCategory') }}"><button type="button" class="btn btn-secondary btn-sm">Nhập thêm</button></a>
            <div class="float-right">
                <div class="input-group">
                    <input type="text" class="form-control" name="" placeholder="Tìm kiếm...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $key => $value)
                        <tr>
                            <td class="col-1 text-center"><input type="checkbox" name="" value=""></td>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->name }}</td>
                            <td class="text-center">
                                <img src="{{ Storage::url($value->image) }}" alt="" width="80px">
                            </td>
                            <td>
                                @if($value->status == 1)
                                    Còn nhập hàng
                                @elseif($value->status == 0)
                                    Dừng nhập hàng
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.categories.updateCategory', $value->id) }}"><button class="btn btn-warning">Sửa</button></a>

                                <form action="{{route('admin.categories.deleteCategory') }}" method="post">

                                    @csrf 
                                    @method('delete')
                                    <input type="hidden" value="{{ $value->id }}" name="id">
                                    <button class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection