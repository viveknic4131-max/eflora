<h2 class="fw-bold mb-4 section-title text-center">BSI Volume</h2>
<ul class="list-unstyled mb-4">
    @foreach ($bsiVolume as $volume)
        <li class="mb-3">
            <a href="{{ route('get.family', ['volume' => $volume['volume_code']]) }}" class="volume-link">
                <i class="fa-solid fa-seedling me-2 text-accent"></i>
                {{ $volume['volume'] }} - {{ $volume['name'] }}
            </a>
        </li>
    @endforeach
</ul>

<div class="pagination-container">
    {{ $bsiVolume->onEachSide(1)->links('pagination::bootstrap-4') }}
</div>
