@php
    $route = Str::replaceLast('.index', '', Route::currentRouteName());

    $options = array_merge([
        'show' => true,
        'edit' => true,
        'delete' => true,
    ], (array) ($options ?? []));
@endphp

@if($options['show'])
<a href="{{ route($route . '.show', $data) }}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
@endif

@if($options['edit'])
<a href="{{ route($route . '.edit', $data) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
@endif

@if($options['delete'])
<form id="delete-form-{{ $data->id }}" action="{{ route($route .'.destroy', $data) }}" method="POST" style="display: none;">
    @csrf
    @method('delete')
</form>

<a class="btn btn-sm btn-danger" href="{{ route($route .'.destroy', $data) }}"
   onclick="event.preventDefault();
           document.getElementById('delete-form-{{ $data->id }}').submit();">
    <i class="fas fa-trash"></i>
</a>
@endif