<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-primary">
        <li class="breadcrumb-item">
            <a href="{{ $homeRoute['url'] }}">{{ $homeRoute['name'] }}</a>
        </li>
        @isset($parentRoute)
            <li class="breadcrumb-item">
                <a href="{{ $parentRoute['url'] ?? '#' }}">{{ $parentRoute['name'] }}</a>
            </li>
        @endisset

        <li class="breadcrumb-item active" aria-current="page">
            {{ $currentRoute['name'] }}
        </li>
        
 </ol>
    
</nav>
