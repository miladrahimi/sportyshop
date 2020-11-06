@extends('admin._layout')

@section('title', 'Product List')

@section('main')
    <main>
        <div class="form-group">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        </div>
        <form method="get" action="{{ route('admin.products.index') }}" class="form-group">
            <input type="search" name="q" class="form-control persian" title="" value="{{ request('q') }}" placeholder="جستجو">
        </form>
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td class="persian">{{ $p->title }}</td>
                        <td class="persian">{{ number_format($p->price) }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-info">Edit</a>
                            <a href="{{ route('admin.products.delete', $p) }}" class="btn btn-sm btn-danger">Delete</a>
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
