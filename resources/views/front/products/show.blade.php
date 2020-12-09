@extends('front._layout')

@section('title', trans('e.title', ['title' => $product->title]))

@section('description', brief(unLine($product->content)))

@section('headline', trans('e.title', ['title' => $product->title]))

@section('page-styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/product.css')) }}">
@endsection

@section('main')
    <article class="container product">
        @if($photos = $product->photos())
            <div class="row">
                <div class="col">
                    <h2>{{ 'تصاویر ' . $product->title }}</h2>
                </div>
            </div>
            <div class="row">
                @foreach($photos as $photo)
                    <div class="col-sm-6 col-md-4 col-lg-3 pb-4">
                        <p>
                            <img src="{{ photoUrl($photo) }}" class="img-fluid" alt="{{ 'عکس '.$product->title }}">
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <h2>{{ 'مشخصات محصول ' . $product->title }}</h2>
                <p>{!! html($product->content) !!}</p>
            </div>
            <div class="col-md-4">
                <h2>{{ 'قیمت ' . $product->title }}</h2>
                <p class="price">
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
                    <label v-for="(values, name) in attributeNames" class="mr-1  d-block">
                        @{{ name }}:
                        <select class="form-control" v-model="form[name]">
                            <option v-for="v in values">@{{ v }}</option>
                        </select>
                    </label>
                    <label class="mr-1 d-block">
                        <span>تعداد</span>:
                        <input type="number" v-model="count" class="form-control" min="1" max="10">
                    </label>
                    <label class=" d-block">
                        <span>&nbsp;</span>
                        <button type="button" class="btn btn-green btn-block"
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
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                attributes: @json($product->attributes->map->only(['id', 'count', 'record'])),
                form: {},
                count: 1,
                record: false,
                eligible: false,
                finished: false,
            },
            computed: {
                attributeNames: function () {
                    let attributes = {};

                    this['attributes'].forEach(function (model) {
                        for (let a in model['record']) {
                            if (model['record'].hasOwnProperty(a)) {
                                if (!attributes.hasOwnProperty(a)) {
                                    attributes[a] = [];
                                }

                                attributes[a].push(model['record'][a]);
                            }
                        }
                    });

                    return attributes;
                },
            },
            watch: {
                form: {
                    deep: true,
                    handler: function () {
                        let app = this;

                        if (Object.keys(app['form']).length !== Object.keys(app['attributes'][0]['record']).length) {
                            return app['eligible'] = app['finished'] = app['record'] = false;
                        }

                        for (let index = 0; index < app['attributes'].length; index++) {
                            let model = app['attributes'][index];
                            let found = true;

                            app['eligible'] = app['finished'] = app['record'] = false;

                            for (let field in app.form) {
                                if (app.form.hasOwnProperty(field) || model['record'].hasOwnProperty(field)) {
                                    if (app.form[field] !== model['record'][field]) {
                                        found = false;
                                        break;
                                    }
                                }
                            }

                            if (found && model['count'] > app.count) {
                                app.eligible = true;
                                app.finished = false;
                                app.record = index;
                                break;
                            }

                            app.finished = true;
                        }
                    }
                },
                count: function (val) {
                    if (this['record'] !== false) {
                        this['finished'] = val > this['attributes'][this['record']]['count'];
                    }
                }
            },
            methods: {
                buy: function () {
                    let card = localStorage.getItem('card');
                    card = card ? JSON.parse(card) : [];

                    card.push({
                        id: '{{ $product->id }}',
                        title: '{{ $product->title }}',
                        price: parseInt('{{ $product->price }}'),
                        count: this.count,
                        attributes: this['attributes'][this['record']],
                    });

                    localStorage.setItem('card', JSON.stringify(card));

                    $('#cardModal').modal('show');
                },
            }
        });
    </script>
@endsection
