<h2 class="fw-bold mb-4 section-title text-center">Flora Of India</h2>
<ul class="list-unstyled mb-4">
    <li class="mb-3">
            <a href="{{ route('get.family', ['volume' => $flora['volume_code']]) }}" class="volume-link">
                <i class="fa-solid fa-tree me-2 text-accent"></i>
                {{ $flora['volume'] }} - {{ $flora['name'] }}
            </a>
        </li>
        <li class="mb-3">
            <a href="{{ route('get.family', ['volume' => $flora['volume_code']]) }}" class="volume-link">
                <i class="fa-solid fa-tree me-2 text-accent"></i>
                {{ $flora['volume'] }} - {{ $flora['name'] }}
            </a>
        </li>
        <li class="mb-3">
            <a href="{{ route('get.family', ['volume' => $flora['volume_code']]) }}" class="volume-link">
                <i class="fa-solid fa-tree me-2 text-accent"></i>
                {{ $flora['volume'] }} - {{ $flora['name'] }}
            </a>
        </li>
    {{-- @foreach ($floraofIndia as $flora)
        <li class="mb-3">
            <a href="{{ route('get.family', ['volume' => $flora['volume_code']]) }}" class="volume-link">
                <i class="fa-solid fa-tree me-2 text-accent"></i>
                {{ $flora['volume'] }} - {{ $flora['name'] }}
            </a>
        </li>
    @endforeach --}}
</ul>

<div class="pagination-container">
    {{-- {{ $floraofIndia->onEachSide(1)->links('pagination::bootstrap-5') }} --}}
    {{ $floraofIndia->onEachSide(1)->links('pagination::bootstrap-4') }}
</div>
