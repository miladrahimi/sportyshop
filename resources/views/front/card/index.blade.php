@extends('front._layout')

@section('title', 'سبد خرید')

@section('main')
    <div class="container persian text-right" id="app">
        <div class="row">
            <div class="col">
                <p v-if="Object.keys(products).length == 0" class="bg-secondary text-light p-5">
                    شما هیچ محصولی در سبد خرید ندارید!
                </p>

                <div v-else>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام محصول</th>
                                <th>مشخصات</th>
                                <th>تعداد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(p, pi) in products">
                                <td>@{{ p['id'] }}</td>
                                <td>@{{ p['name'] }}</td>
                                <td>
                                    <ul>
                                        <li v-for="(v,k) in p['attributes']">
                                            @{{ k }}: @{{ v }}
                                        </li>
                                    </ul>
                                </td>
                                <td>@{{ p['count'] }}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger" v-on:click="products.splice(pi, 1)">حذف
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @if(auth()->check())
                        <form class="form-group text-center" method="post" action="{{ route('card.pay') }}">
                            @csrf
                            <input type="hidden" name="products" :value="JSON.stringify(products)">
                            <button type="submit" class="btn btn-success">پرداخت</button>
                        </form>
                    @else
                        <a href="{{ route('auth.otp.show') }}">ورود / نام‌نویسی</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('vendor/vue.min.js') }}"></script>
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                products: {},
            },
            methods: {
                init: function () {
                    let card = localStorage.getItem('card');
                    this.products = card ? JSON.parse(card) : {};
                }
            }
        });

        app.init();
    </script>
@endsection
