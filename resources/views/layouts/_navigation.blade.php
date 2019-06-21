<li class="nav-item @activeRoute('admin.dashboard')">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>@lang('Главная')</span>
    </a>
</li>

@foreach(config('admin.navigation', []) as $item)
<li class="nav-item @activeRoute('admin.translations.*')">
    <a href="{{ route($item['link']) }}" class="nav-link">
        <i class="fas fa-fw {{ $item['icon'] }}"></i>
        <span>@lang($item['name'])</span>
    </a>
</li>
@endforeach