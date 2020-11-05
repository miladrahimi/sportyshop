@extends('admin._layout')

@section('title', 'محصولات - لیست')

@section('main')
    <main class="text-center">
        <div class="form-group">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">افزودن محصول</a>
        </div>
        <form method="get" action="{{ route('admin.products.index') }}" class="form-group">
            <input type="search" name="q" class="form-control rtl" title="" value="{{ request('q') }}" placeholder="جستجو">
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>قیمت</th>
                    <th>گزینه‌ها</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->title }}</td>
                        <td>{{ number_format($p->price) }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-info">ویرایش</a>
                            <a href="{{ route('admin.products.delete', $p) }}" class="btn btn-sm btn-danger">پاک‌کردن</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $products->render() !!}
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('nav a[data-to="products"]').addClass('active');
        });
    </script>
@endsection
