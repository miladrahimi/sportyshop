@extends('admin._layout')

@section('title', 'Add Product')

@section('main')
    <main>
        <h1>@yield('title')</h1>
        <div class="card">
            <div class="card-header">Basic Attributes</div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="post">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control persian" title="" value="{{ old('title') }}"
                               placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="number" name="price" class="form-control persian" title=""
                               value="{{ old('price') }}"
                               placeholder="Price">
                    </div>
                    <div class="form-group">
                <textarea name="content" class="form-control persian" title="" style="min-height: 200px"
                          placeholder="Content">{{ old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        @csrf
                        <button class="btn btn-success">Publish</button>
                        <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Back</a>
                    </div>
                </form>
            </div>
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
