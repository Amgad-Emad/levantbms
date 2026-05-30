{{-- Resolved by App\View\Composers\SeoComposer --}}
<title>{{ $seoTitle ?? config('app.name') }}</title>
@if (!empty($seoDescription))<meta name="description" content="{{ $seoDescription }}" />@endif
@if (!empty($seoKeywords))<meta name="keywords" content="{{ $seoKeywords }}" />@endif
<meta name="robots" content="{{ $seoRobots ?? 'index, follow' }}" />
<link rel="canonical" href="{{ $seoCanonical ?? url()->current() }}" />

{{-- hreflang alternates --}}
@foreach (($seoAlternates ?? []) as $loc => $href)
    <link rel="alternate" hreflang="{{ $loc }}" href="{{ $href }}" />
@endforeach
@if (!empty($seoAlternates['en']))<link rel="alternate" hreflang="x-default" href="{{ $seoAlternates['en'] }}" />@endif

{{-- Open Graph --}}
<meta property="og:type" content="{{ $seoOgType ?? 'website' }}" />
<meta property="og:site_name" content="LevantBMS" />
<meta property="og:title" content="{{ $seoRawTitle ?? $seoTitle ?? '' }}" />
@if (!empty($seoDescription))<meta property="og:description" content="{{ $seoDescription }}" />@endif
<meta property="og:url" content="{{ $seoCanonical ?? url()->current() }}" />
@if (!empty($seoOgImage))<meta property="og:image" content="{{ $seoOgImage }}" />@endif
<meta property="og:locale" content="{{ ($seoLocale ?? 'en') === 'ar' ? 'ar_BH' : 'en_GB' }}" />

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image" />
@if (!empty($seoTwitter))<meta name="twitter:site" content="{{ $seoTwitter }}" />@endif
<meta name="twitter:title" content="{{ $seoRawTitle ?? $seoTitle ?? '' }}" />
@if (!empty($seoDescription))<meta name="twitter:description" content="{{ $seoDescription }}" />@endif
@if (!empty($seoOgImage))<meta name="twitter:image" content="{{ $seoOgImage }}" />@endif

{{-- JSON-LD structured data (Organization + contextual FAQ/Article) --}}
@if (!empty($seoJsonLd))
<script type="application/ld+json">{!! json_encode($seoJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
