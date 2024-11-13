<!-- resources/views/chamados/custom.blade.php -->

@if ($paginator->hasPages())

    <div class="pagination-wrapper">
        <ul class="pagination">

        
            {{-- Link para a primeira página --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&lt;&lt;</span></li>
            @else
                <li><a href="{{ $paginator->url(1) }}" rel="prev">&lt;&lt;</a></li>
            @endif
            {{-- Botão "Página Anterior" --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&lt;</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a></li>
            @endif
            {{-- Lógica para exibir páginas --}}
            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                $maxLinks = 5; // Número máximo de botões de paginação que você deseja mostrar
                $halfTotalLinks = floor($maxLinks / 2);
            @endphp

            {{-- Exibir números das páginas --}}
            @if ($currentPage > $halfTotalLinks + 1)
                <li><a href="{{ $paginator->url(1) }}">1</a></li>
                @if ($currentPage > $halfTotalLinks + 2)
                    <li class="disabled"><span>...</span></li>
                @endif
            @endif

            @for ($i = max(1, $currentPage - $halfTotalLinks); $i <= min($lastPage, $currentPage + $halfTotalLinks); $i++)
                @if ($i == $currentPage)
                    <li class="active"><span>{{ $i }}</span></li>
                @else
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            @if ($currentPage < $lastPage - $halfTotalLinks)
                @if ($currentPage < $lastPage - $halfTotalLinks - 1)
                    <li class="disabled"><span>...</span></li>
                @endif
                <li><a href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a></li>
            @endif

       

            {{-- Botão "Próxima Página" --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a></li>
            @else
                <li class="disabled"><span>&gt;</span></li>
            @endif

            {{-- Link para a última página --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->url($paginator->lastPage()) }}" rel="next">&gt;&gt;</a></li>
            @else
                <li class="disabled"><span>&gt;&gt;</span></li>
            @endif
        </ul>

        {{-- Mostrando a quantidade total de páginas --}}
        <div>
            Página {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}
        </div>

        {{-- Campo de entrada para ir para uma página específica --}}
        <form action="{{ url()->current() }}" method="GET">
            <input type="number" name="page" min="1" max="{{ $paginator->lastPage() }}" placeholder="Ir para a página" value="{{$paginator->currentPage()}}">
            <button class="btn-abrir" type="submit">Ir</button>
        </form>
    </div>
@endif
