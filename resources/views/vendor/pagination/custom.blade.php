@if ($paginator->hasPages())
    <nav class="pagination-wrapper" role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled">
                    <span class="pagination-link">
                        <i class="fas fa-chevron-left"></i>
                        <span class="pagination-text">Previous</span>
                    </span>
                </li>
            @else
                <li class="pagination-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link" rel="prev">
                        <i class="fas fa-chevron-left"></i>
                        <span class="pagination-text">Previous</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item disabled">
                        <span class="pagination-link dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item active">
                                <span class="pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link" rel="next">
                        <span class="pagination-text">Next</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="pagination-item disabled">
                    <span class="pagination-link">
                        <span class="pagination-text">Next</span>
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>

        {{-- Results Summary --}}
        <div class="pagination-summary">
            <p>
                Showing <strong>{{ $paginator->firstItem() }}</strong> to 
                <strong>{{ $paginator->lastItem() }}</strong> of 
                <strong>{{ $paginator->total() }}</strong> results
            </p>
        </div>
    </nav>

    <style>
    :root {
        --primary-color: #8B4513;
        --primary-dark: #6d3410;
        --primary-light: #a0522d;
    }

    .pagination-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        margin-top: 40px;
    }

    .pagination-list {
        display: flex;
        align-items: center;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination-item {
        display: inline-block;
    }

    .pagination-link {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 45px;
        height: 45px;
        padding: 0 16px;
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        color: var(--primary-color);
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .pagination-link:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.3);
    }

    .pagination-item.active .pagination-link {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-color: var(--primary-color);
        color: white;
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.3);
    }

    .pagination-item.disabled .pagination-link {
        background: #f8f9fa;
        border-color: #e0e0e0;
        color: #ccc;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .pagination-item.disabled .pagination-link:hover {
        background: #f8f9fa;
        border-color: #e0e0e0;
        color: #ccc;
        transform: none;
        box-shadow: none;
    }

    .pagination-link.dots {
        border: none;
        background: transparent;
        cursor: default;
    }

    .pagination-link.dots:hover {
        transform: none;
        box-shadow: none;
    }

    .pagination-link i {
        font-size: 0.85rem;
    }

    .pagination-text {
        display: inline-block;
    }

    .pagination-summary {
        text-align: center;
        padding: 15px 25px;
        background: linear-gradient(135deg, #f8f4ed, white);
        border-radius: 50px;
        border: 2px solid #f0f0f0;
    }

    .pagination-summary p {
        margin: 0;
        color: #666;
        font-size: 0.95rem;
    }

    .pagination-summary strong {
        color: var(--primary-color);
        font-weight: 700;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .pagination-link {
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            font-size: 0.85rem;
        }

        .pagination-text {
            display: none;
        }

        .pagination-link i {
            margin: 0;
        }

        .pagination-summary {
            padding: 12px 20px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 380px) {
        .pagination-list {
            gap: 5px;
        }

        .pagination-link {
            min-width: 35px;
            height: 35px;
            padding: 0 10px;
        }
    }
    </style>
@endif