@extends('front._layout')

@section('title', $product->title)

@section('page-styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/products.css')) }}">
@endsection

@section('main')
    <article class="container persian text-right">
        <div class="row">
            <div class="col">
                <h1 class="bg-orange rounded h3 py-2 px-3 mb-4">{{ $product->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="h4">{{ 'تصاویر ' . $product->title }}</h2>
            </div>
        </div>
        <div class="row">
            @if($photos = $product->photos())
                @foreach($photos as $photo)
                    <div class="col-md-3 pb-4">
                        <p class="product">
                            <img src="{{ photoUrl($photo) }}" class="img-fluid" alt="{{ $product->title }}">
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col">
                    <p class="py-2 px-5 bg-info">این محصول تصویر ندارد.</p>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8">
                <h2 class="h4">{{ 'مشخصات محصول ' . $product->title }}</h2>
                <p>{!! html($product->content) !!}</p>
            </div>
            <div class="col-md-4">
                <h2 class="h4">{{ 'قیمت ' . $product->title }}</h2>
                <p class="border border-primary bg-yellow p-2 rounded text-center h5">
                    <span>{{ number_format($product->price / 10) }}</span>
                    <span>تومان</span>
                </p>
                <h2 class="h4 mt-3">{{ 'خرید ' . $product->title }}</h2>
                <p>
                    <span>برای خرید</span>
                    <span>{{ $product->title }}</span>
                    <span>ویژگی های مربوط به آنرا انتخاب کنید و بر روی دکمه خرید کلیک کنید.</span>
                </p>
                <div id="app">
                    <label v-for="(values, name) in attributes" class="mr-1  d-block">
                        @{{ name }}:
                        <select class="form-control" v-model="form[name]">
                            <option v-for="v in values">@{{ v }}</option>
                        </select>
                    </label>
                    <label class="mr-1 d-block">
                        <span>تعداد</span>:
                        <input type="number" v-model="count" class="form-control">
                    </label>
                    <label class=" d-block">
                        <span>&nbsp;</span>
                        <button type="button" class="btn btn-success btn-block"
                                @click="buy" :disabled="!eligible || finished">
                            @{{ finished ? 'عدم موجودی' : 'خرید' }}
                        </button>
                    </label>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/vue.min.js') }}"></script>
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                records: @json($records),
                attributes: @json($attributes),
                form: {},
                count: 1,
                record: {},
                eligible: false,
                finished: false,
            },
            watch: {
                form: {
                    deep: true,
                    handler: function () {
                        this.eligible = this.finished = this.record = false;

                        if (Object.keys(this.form).length !== Object.keys(this.records[0]).length - 1) {
                            return;
                        }

                        for (let r in this.records) {
                            if (this.records.hasOwnProperty(r)) {
                                let found = 1;

                                for (let a in this.form) {
                                    if (this.form.hasOwnProperty(a) && this.records[r].hasOwnProperty(a)) {
                                        if (this.form[a] !== this.records[r][a]) {
                                            found = 0;
                                            break;
                                        }
                                    } else {
                                        found = 0;
                                    }
                                }

                                if (found && this.records[r].hasOwnProperty('count')) {
                                    if (this.records[r]['count'] > this.count) {
                                        this.eligible = true;
                                        this.record = this.records[r];
                                        break;
                                    }
                                }

                                this.finished = true;
                            }
                        }
                    }
                },
                count: function (val) {
                    this.finished = this.record && val > this.record['count'];
                }
            },
            methods: {
                buy: function () {
                    let record = {...this.record};
                    delete record['count'];

                    let item = {};
                    item['count'] = this.count;
                    item['id'] = '{{ $product->id }}';
                    item['name'] = '{{ $product->title }}';
                    item['attributes'] = record;

                    let card = localStorage.getItem('card');
                    card = card ? JSON.parse(card) : {};

                    card['{{ $product->id }}'] = item;

                    localStorage.setItem('card', JSON.stringify(card));
                    
                    window.location.href = '{{ route('card.index') }}';
                },
            }
        });
    </script>
@endsection
