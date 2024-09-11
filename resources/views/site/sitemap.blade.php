<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach ($products as $product)
        <url>
            <loc>{{ route('product.show', [$product->id, $product->slug]) }}</loc>
            <lastmod>{{ Carbon\Carbon::parse($product->created_at)->format('Y-m-d\TH:i:s.uP') }}</lastmod>
        </url>
    @endforeach

    @foreach ($posts as $post)
        <url>
            <loc>{{ route('site.posts.view', [$post->type, $post->id, $post->slug]) }}</loc>
            <lastmod>{{ Carbon\Carbon::parse($post->date_public)->format('Y-m-d\TH:i:s.uP') }}</lastmod>
        </url>
    @endforeach
</urlset>
