@php($secondLast = $lastPage - 1)
@php($nextPage = $currentPage + 1)

<div class="mt-3 pagination-custom">
    <nav>
        <ul class="pagination d-flex justify-content-end">
            <li data-page="{{ $currentPage }}" class="page-item {{ ($currentPage == 1) ? "disabled" : "" }}">
                <a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $currentPage - 1 }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @if($lastPage > 10) 
                @if($currentPage <= 4) 
                    @for($i = 1; $i < 8; $i++)
                        <li data-page="{{ $currentPage }}" class="page-item {{ ($currentPage == $i) ? "active" : "" }}">
                            <a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li data-page="{{ $currentPage }}" class="page-item disabled"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}">...</a></li>
                    <li data-page="{{ $currentPage }}" class="page-item"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $secondLast }}">{{ $secondLast }}</a></li>
                    <li data-page="{{ $currentPage }}" class="page-item"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $lastPage }}">{{ $lastPage }}</a></li>
                @elseif ($currentPage > 4 && $currentPage < $lastPage - 4)
                    <li data-page="{{ $currentPage }}" class="page-item"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="1">1</a></li>
                    <li data-page="{{ $currentPage }}" class="page-item"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="2">2</a></li>
                    <li data-page="{{ $currentPage }}" class="page-item disabled"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}">...</a></li>

                    @for($x = $currentPage - 2; $x <= $currentPage + 2; $x++)
                        <li data-page="{{ $currentPage }}" class="page-item {{ ($currentPage == $x) ? "active" : "" }}">
                            <a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $x }}">{{ $x }}</a>
                        </li>
                    @endfor

                    <li data-page="{{ $currentPage }}" class="page-item disabled"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}">...</a></li>
                    <li data-page="{{ $currentPage }}" class="page-item"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $secondLast }}">{{ $secondLast }}</a></li>
                    <li data-page="{{ $currentPage }}" class="page-item disabled"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $lastPage }}">{{ $lastPage }}</a></li>
                @else 
                    <li data-page="{{ $currentPage }}" class="page-item"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="1">1</a></li>
                    <li data-page="{{ $currentPage }}" class="page-item"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="2">2</a></li>
                    <li data-page="{{ $currentPage }}" class="page-item disabled"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}">...</a></li>

                    @for($z = $lastPage - 6; $z <= $lastPage; $z++)
                        <li data-page="{{ $currentPage }}" class="page-item {{ ($currentPage == $z) ? "active" : "" }}"><a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $z }}">{{ $z }}</a></li>
                    @endfor
                @endif
            @else 
                @for($ab = 1; $ab <= $lastPage; $ab++)
                    <li data-page="{{ $currentPage }}" class="page-item {{ ($currentPage == $ab) ? "active" : "" }}">
                        <a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $ab }}">{{ $ab }}</a>
                    </li>
                @endfor
            @endif
            <li data-page="{{ $currentPage }}" class="page-item {{ ($currentPage == $lastPage) ? "disabled" : "" }}">
                <a class="page-link link-pagination-custom" data-join="{{ $join }}" data-view="{{ $paginationView }}" data-component="{{ $component }}" data-select="{{ $select }}" data-table="{{ $table }}" data-condition="{{ $condition }}" data-target="{{ $tableTarget }}" data-page="{{ $nextPage }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>