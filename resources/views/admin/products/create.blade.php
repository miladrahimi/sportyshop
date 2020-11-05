@extends('admin._layout')

@section('title', 'محصولات - افزودن محصول')

@section('main')
    <main>
        <p class="text-center">افزودن محصول</p>
        <form action="{{ route('admin.products.store') }}" method="post">
            <div class="form-group">
                <input type="text" name="title" class="form-control rtl" title="" value="{{ old('title') }}"
                       placeholder="عنوان" required>
            </div>
            <div class="form-group">
                <input type="number" name="price" class="form-control rtl" title="" value="{{ old('price') }}"
                       placeholder="قیمت" required>
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control rtl" title="" style="min-height: 200px"
                          placeholder="محتوا" required>{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                @csrf
                <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">برگشت</a>
                <button class="btn btn-success">انتشار</button>
            </div>
        </form>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('nav a[data-to="products"]').addClass('active');
        });
    </script>
@endsection
