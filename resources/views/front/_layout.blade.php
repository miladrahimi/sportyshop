@extends('front._html')

@section('styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/layout.css')) }}">
    @yield('page-styles')
@endsection

@section('body')
    <div class="container mt-2 mt-sm-4">
        <header class="row d-sm-none mobile mb-4">
            <div class="col text-right">
                <section class="float-right d-flex">
                    <a href="{{ route('home') }}" class="d-inline-block">
                        <img src="{{ fh(asset('img/logo.png')) }}" class="img-fluid logo" alt="لوگوی اسپرتات">
                    </a>
                    <a class="h2" href="{{ route('home') }}">اسپرتات</a>
                </section>
                <nav class="d-inline-block float-left my-auto">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-folder-open"></i>
                    </a>
                    @if(auth()->check())
                        <a href="{{ route('account.profile.show') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-user"></i>
                        </a>
                    @else
                        <a href="{{ route('auth.otp.show') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-user"></i>
                        </a>
                    @endif
                    <a href="#" class="btn btn-outline-secondary" data-toggle="modal"
                       data-target="#cardModal">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </nav>
            </div>
        </header>
        <header class="row d-none d-sm-flex">
            <div class="col-md-3 col-lg-2 col-xl-2 pb-2 text-center text-md-left my-auto">
                <a href="{{ route('home') }}" class="d-inline-block">
                    <img src="{{ fh(asset('img/logo.png')) }}" class="img-fluid logo" alt="لوگوی اسپرتات">
                </a>
            </div>
            <div class="col-md-9 col-lg-10 col-xl-10 text-center text-md-right my-auto">
                <a class="h2" href="{{ route('home') }}">فروشگاه اینترنتی اسپرتات</a>
                <p>
                    <span class="d-block d-sm-inline">خرید لوازم رزمی و پوشاک ورزشی</span>
                    <span class="d-block d-sm-inline">با امکان ارسال پستی به سراسر کشور</span>
                </p>
                <nav>
                    <label class="text-center d-block d-sm-inline-block">
                        <span class="d-block mb-1">محصولات</span>
                        <a href="{{ route('products.index') }}" class="btn btn-block btn-outline-secondary">
                            <i class="fas fa-folder-open"></i>
                            <span>({{ $totalProductCount }})</span>
                        </a>
                    </label>
                    <label class="text-center d-block d-sm-inline-block">
                        <span class="d-block mb-1">پروفایل من</span>
                        @if(auth()->check())
                            <a href="{{ route('account.profile.show') }}" class="btn btn-block btn-outline-secondary">
                                <i class="fas fa-user"></i>
                                <span>{{ auth()->user()->cellphone }}</span>
                            </a>
                        @else
                            <a href="{{ route('auth.otp.show') }}" class="btn btn-block btn-outline-secondary">
                                <i class="fas fa-user"></i>
                                <span>ورود/نام‌نویسی</span>
                            </a>
                        @endif
                    </label>
                    <label class="text-center d-block d-sm-inline-block">
                        <span class="d-block mb-1">سبد خرید</span>
                        <a href="#" class="btn btn-block btn-outline-secondary" data-toggle="modal"
                           data-target="#cardModal">
                            <i class="fas fa-shopping-cart"></i>
                            (<span id="cardButton"> ... </span>)
                        </a>
                    </label>
                </nav>
            </div>
        </header>
        <hr class="d-none d-sm-block">
        <div class="row ltr">
            <section class="col-md-4 rtl" id="search-box">
                <form action="{{ route('search.index') }}" method="get">
                    <input type="search" name="q" class="form-control" value="{{ request('q') }}"
                           title="جستجو" placeholder="جستجو">
                    <i class="fas fa-search icon"></i>
                </form>
            </section>
            <hr class="d-md-none my-4 rtl">
            <section class="col-md-8 text-center text-md-right">
                <h1>@yield('headline')</h1>
            </section>
        </div>
        <hr>
    </div>

    <div class="container">
        @include('front._alerts')
    </div>

    @yield('main')

    <div class="container my-3">
        <hr>
        <footer>
            <div class="row">
                <nav class="col text-center">
                    <a href="{{ route('home') }}" class="text-muted d-inline-block">خانه</a>
                    <a href="{{ route('about.show') }}" class="text-muted d-inline-block">درباره ما</a>
                    <a href="{{ route('contact.show') }}" class="text-muted d-inline-block">ارتباط با ما</a>
                </nav>
            </div>
            <div class="row mt-2">
                <p class="col text-center">
                    <span class="d-block d-sm-inline">تمامی حقوق این وب‌سایت</span>
                    <span class="d-block d-sm-inline">ازآن «اسپرتات» می‌باشد.</span>
                </p>
            </div>
        </footer>
    </div>

    <div class="modal fade" id="cardModal" tabindex="-1" role="dialog"
         aria-labelledby="cardModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cardModalLabel">سبد خرید</h5>
                </div>
                <div class="modal-body">
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
                                            <th>محصول</th>
                                            <th>مشخصات</th>
                                            <th>تعداد</th>
                                            <th>قیمت (تومان)</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(p, pi) in products">
                                            <td>@{{ pi + 1 }}</td>
                                            <td>@{{ p['title'] }}</td>
                                            <td>
                                                <ul class="m-0 pr-2">
                                                    <li v-for="(v,k) in p['attributes']['record']">
                                                        @{{ k }}: @{{ v }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>@{{ p['count'] }}</td>
                                            <td>@{{ number(p['count'] * (p['price'] / 10)) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-danger btn-block"
                                                        @click="products.splice(pi, 1)">حذف
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr class="bg-yellow">
                                            <td></td>
                                            <td>جمع کل</td>
                                            <td></td>
                                            <td>@{{ totalCount }}</td>
                                            <td>@{{ number(totalPrice) }}</td>
                                            <td></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <form class="form-group text-center" method="post" action="{{ route('card.pay') }}"
                          id="cardModalForm">
                        @csrf
                        <input type="hidden" name="products" :value="JSON.stringify(products)">
                        <button type="submit" class="btn btn-success btn-wide">پرداخت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('layout-script')
    <script src="{{ asset('vendor/vue.min.js') }}"></script>
    <script>
        let card = new Vue({
            el: '#cardModal',
            data: {
                products: {},
            },
            computed: {
                totalCount: function () {
                    let total = 0;
                    this.products.forEach(function (p) {
                        total += parseInt(p['count']);
                    });

                    return total;
                },
                totalPrice: function () {
                    let total = 0;
                    this.products.forEach(function (p) {
                        total += p['count'] * p['price'] / 10;
                    });

                    return total;
                },
            },
            watch: {
                products: {
                    deep: true,
                    handler: function () {
                        localStorage.setItem('card', JSON.stringify(this.products));
                        $('#cardButton').html(this.products.length);
                    }
                }
            },
            methods: {
                init: function () {
                    let card = localStorage.getItem('card');
                    this.products = card ? JSON.parse(card) : [];
                    $('#cardButton').html(card.length);
                },
                number: function (n) {
                    return new Intl.NumberFormat('en-US', {maximumSignificantDigits: 3}).format(n);
                }
            },
        });

        $("#cardModal").on('shown.bs.modal', function () {
            card.init();
        });

        $('#cardModalForm').submit(function () {
            if (parseInt('{{ auth()->check() }}')) {
                localStorage.setItem('card', JSON.stringify([]));
            }
        });

        card.init();
    </script>
    @yield('scripts')
@endsection
