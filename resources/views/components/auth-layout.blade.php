@php $locale = app()->getLocale(); @endphp
<!doctype html>
<html lang="{{ $locale }}" class="scroll-smooth">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>{{ $title ?? 'Sign in' }} · LevantBMS</title>
<link rel="stylesheet" href="{{ asset('front/tw/assets/style.css') }}" />
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    darkMode: 'class',
    theme: {
      extend: {
        colors: {
          navy:   { 900:'#06182F', 800:'#0A1F3D', 700:'#0B2545', 600:'#14315A', 500:'#1F4275', 300:'#3E6BA8', 100:'#D8E0EE' },
          orange: { 700:'#C45A18', 600:'#E5701F', 500:'#F58220', 400:'#FF9846', 100:'#FFE4CC' },
          cream:'#FAF7F2', cream2:'#F2EDE3', ink:'#0A1224', ink2:'#1A2440', mute:'#5B6982',
        },
        fontFamily: {
          display: ['Sora','ui-sans-serif','system-ui','sans-serif'],
          body:    ['Manrope','ui-sans-serif','system-ui','sans-serif'],
          serif:   ['Fraunces','ui-serif','Georgia','serif'],
          mono:    ['"JetBrains Mono"','ui-monospace','monospace'],
        },
        maxWidth: { container: '1320px' },
        boxShadow: {
          'sm-soft': '0 1px 2px rgba(10,18,36,.06), 0 1px 0 rgba(10,18,36,.04)',
          'md-soft': '0 8px 24px -8px rgba(10,18,36,.18), 0 4px 12px -4px rgba(10,18,36,.08)',
          'lg-soft': '0 24px 60px -16px rgba(10,18,36,.32), 0 8px 24px -8px rgba(10,18,36,.16)',
        },
      }
    }
  };
</script>
</head>
<body class="bg-cream text-ink font-body antialiased">
{{ $slot }}
</body>
</html>
