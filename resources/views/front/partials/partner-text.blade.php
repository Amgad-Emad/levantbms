<div class="eyebrow mb-4"><span>{{ $partner->tag }}</span> · <span>{{ $partner->region }}</span></div>
<h2 class="font-display font-medium text-[clamp(32px,4vw,52px)] tracking-tight mb-6">{{ $partner->name }}</h2>
<p class="text-lg text-mute dark:text-cream/60 leading-relaxed mb-6">{{ $partner->body }}</p>
<div class="flex flex-wrap gap-2">
  @foreach ($partner->servicesFor() as $service)
    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white dark:bg-navy-700 border border-ink/10 dark:border-white/10 text-xs font-medium"><span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span><span>{{ $service }}</span></span>
  @endforeach
</div>
