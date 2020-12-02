<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($items as $item)
        <url>
            <loc>{{ $item['loc'] }}</loc>
            <lastmod>{{ $item['lastmod'] }}</lastmod>
            <changefreq>{{ $item['changefreq'] }}</changefreq>
            <priority>{{ $item['priority'] ?? '1.0' }}</priority>
            @foreach($item['images'] as $image)
                <image:image>
                    <image:loc>{{ $image['loc'] }}</image:loc>
                    <image:title>{{ $image['title'] }}</image:title>
                    <image:caption>{{ $image['caption'] ?? $image['title'] }}</image:caption>
                    @if(isset($image['geo_location']))
                        <image:geo_location>{{ $image['geo_location'] }}</image:geo_location>
                    @endif
                </image:image>
            @endforeach
        </url>
    @endforeach
</urlset>
