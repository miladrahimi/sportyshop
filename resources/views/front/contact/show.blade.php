@extends('front._layout')

@section('title', 'ارتباط با ما')

@section('description', trans('e.home-description'))

@section('headline', 'ارتباط با ما')

@section('page-styles')
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css">
    <style>
        #map {
            height: 30vh;
            width: 100%;
        }

        .number {
            background-color: #efefef;
            padding: 4px 7px 1px;
            direction: ltr;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
@endsection

@section('main')
    <article class="container">
        <div class="row">
            <div class="col">
                <p>برای ارتباط با فروشگاه اسپرتات می‌توانید از طریق شماره های تماس، ایمیل، شبکه های اجتماعی و آدرس پستی اقدام بفرمایید.</p>
            </div>
        </div>
        <div class="row">
            <div class="col position-relative">
                <div id="map"></div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <p>
                    <strong>شماره های تماس:</strong>
                    <span>ثابت</span> <span class="number">021-88462636</span>
                    <span>همراه</span> <span class="number">09354473333</span>
                </p>
                <p>
                    <strong>آدرس پستی:</strong>
                    <span>میدان ونک، خیابان ونک، پلاک ۲۴، طبقه اول، واحد های ۴ و ۵،</span>
                    <span>کد پستی</span> <span class="number">1991944775</span>
                </p>
                <p>
                    <strong>ایمیل:</strong>
                    <span class="ltr">
                        <a href="mailto:info@sportat.ir">info@sportat.ir</a>
                    </span>
                </p>
                <p>
                    <strong>پیج اینستاگرام:</strong>
                    <span class="ltr">
                        <a href="https://www.instagram.com/sportat.ir/">sportat.ir@</a>
                    </span>
                </p>
            </div>
        </div>
    </article>
@endsection

@section('scripts')
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
    <script>
        mapboxgl.accessToken = '{{ config('maps.mapbox.token') }}';
        mapboxgl.setRTLTextPlugin(
            'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js',
            null,
            true,
        );

        let map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [51.406510, 35.759643],
            zoom: 13
        });

        map.addControl(new mapboxgl.NavigationControl());

        new mapboxgl.Marker()
            .setLngLat([51.406510, 35.759643])
            .addTo(map);
    </script>
@endsection
