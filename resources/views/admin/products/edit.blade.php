@extends('admin._layout')

@section('title', 'محصولات - ویرایش محصول')

@section('page-styles')
    <style type="text/css">
        #posts .img-thumbnail {
            margin: 0 5px;
            position: relative;
        }

        #posts img {
            max-width: 150px;
            height: auto;
        }

        #posts .delete {
            border-radius: 50%;
            position: absolute;
            bottom: 15px;
            right: 15px;
            color: darkred;
            font-size: xx-large;
            cursor: pointer;
            transition: .3s ease all;
        }

        #posts .delete:hover {
            color: red;
        }
    </style>
@endsection

@section('main')
    <main id="app">
        <p class="text-center">
            <span>ویرایش محصول کد</span>
            <span class="badge-info px-1 rounded">{{ $product->id }}</span>
        </p>
        <form action="{{ route('admin.products.update', $product) }}" method="post">
            <div class="form-group">
                <input type="text" name="title" class="form-control rtl" title="" value="{{ $product->title }}"
                       placeholder="عنوان">
            </div>
            <div class="form-group">
                <input type="number" name="price" class="form-control rtl" title="" value="{{ $product->price }}"
                       placeholder="قیمت">
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control rtl" title="" style="min-height: 200px"
                          placeholder="محتوا">{{ $product->content }}</textarea>
            </div>
            <div class="form-group">
                @csrf
                @method('PUT')
                <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">برگشت</a>
                <button class="btn btn-success">انتشار</button>
            </div>
            <div class="form-group">
                <p>تصاویر</p>
                <div class="d-flex overflow-auto bg-light py-2" id="posts" v-if="photos.length">
                    <div class="img-thumbnail" v-for="(photo, i) in photos">
                        <img v-bind:src="photo" alt="photo">
                        <div class="delete" @click="deletePhoto(i)"><i class="far fa-times-circle"></i></div>
                    </div>
                </div>
                <div v-else><p>هنوز هیچ تصویری آپلود نشده است.</p></div>
                <div class="form-inline mt-2 rtl">
                    <p v-if="uploading">در حال آپلود فایل...</p>
                    <input type="file" class="form-control-file" @change="uploadPhoto" id="photo"
                           v-else>
                </div>
            </div>
        </form>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/vue.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('nav a[data-to="products"]').addClass('active');
        });

        let app = new Vue({
            el: '#app',
            data: {
                photos: @json($product->photos()),
                attributes: @json([]),
                uploading: false,
            },
            methods: {
                uploadPhoto: () => {
                    let app = this;
                    app.uploading = true;

                    const data = new FormData();
                    data.append('photo', document.getElementById('photo').files[0]);

                    $.ajax({
                        method: 'POST',
                        url: '{{ route('admin.products.photos.store', $product) }}',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                    }).done(() => {
                        window.location.reload();
                    }).fail(e => {
                        console.log(e);
                        alert('آپلود فایل با خطا مواجه شد.')
                    }).always(() => {
                        app.uploading = false;
                    });
                },
                deletePhoto: i => {
                    let app = this;
                    console.log()

                    $.ajax({
                        method: 'DELETE',
                        url: '{{ route('admin.products.photos.delete', $product) }}',
                        data: {
                            photo: app.photos[i],
                        },
                    }).done(() => {
                        window.location.reload();
                    }).fail(e => {
                        console.log(e);
                        alert('حذف فایل با خطا مواجه شد.')
                    }).always(() => {
                        app.uploading = false;
                    })
                },
            },
        });
    </script>
@endsection
