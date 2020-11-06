@extends('admin._layout')

@section('title', 'Edit Product')

@section('page-styles')
    <style type="text/css">
        #photos .img-thumbnail {
            margin: 0 5px;
            position: relative;
        }

        #photos img {
            max-width: 150px;
            height: auto;
        }

        #photos .delete {
            border-radius: 50%;
            position: absolute;
            bottom: 15px;
            right: 15px;
            color: #F82E1A;
            font-size: xx-large;
            cursor: pointer;
            transition: .3s ease all;
            background: white;
            padding: 0 6px;
        }

        #photos .delete:hover {
            background: black;
        }
    </style>
@endsection

@section('main')
    <main id="app">
        <h1>Edit Product #{{ $product->id }}</h1>

        <div class="card">
            <div class="card-header">Basic Attributes</div>
            <div class="card-body">
                <form action="{{ route('admin.products.update', $product) }}" method="post">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control persian" title=""
                               value="{{ $product->title }}"
                               placeholder="Title">
                    </div>
                    <div class="form-group">
                        <input type="number" name="price" class="form-control persian" title=""
                               value="{{ $product->price }}"
                               placeholder="Price">
                    </div>
                    <div class="form-group">
                <textarea name="content" class="form-control persian" title="" style="min-height: 200px"
                          placeholder="Content">{{ $product->content }}</textarea>
                    </div>
                    <div class="form-group">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success">Publish</button>
                        <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Back</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">Photos</div>
            <div class="card-body">
                <div class="d-flex" id="photos" v-if="photos.length">
                    <div class="img-thumbnail" v-for="(photo, i) in photos">
                        <img v-bind:src="photo" alt="photo">
                        <div v-if="deleting !== i" class="delete" @click="deletePhoto(i)"><i class="far fa-times-circle"></i></div>
                    </div>
                    <hr>
                </div>
                <div class="form-inline mt-2">
                    <p v-if="uploading">Uploading...</p>
                    <input type="file" class="form-control-file" @change="uploadPhoto" id="photo" v-else>
                </div>
            </div>
        </div>
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
                deleting: false,
            },
            methods: {
                uploadPhoto: function () {
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
                        app.uploading = false;
                        console.log(e);
                        alert('Cannot upload the photo.');
                    });
                },
                deletePhoto: function (i) {
                    let app = this;
                    app.deleting = i;

                    $.ajax({
                        method: 'DELETE',
                        url: '{{ route('admin.products.photos.delete', $product) }}',
                        data: {
                            url: app.photos[i],
                        },
                    }).done(() => {
                        app.photos.splice(i, 1);
                    }).fail(e => {
                        console.log(e);
                        alert('Cannot delete the photo.')
                    }).always(() => {
                        app.deleting = false;
                    });
                },
            },
        });
    </script>
@endsection
