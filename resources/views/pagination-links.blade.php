@if($paginator->hasPages())
       <div class="d-flex justify-content-between">
           <span>
                {{-- Previous Page Link --}}
               @if ($paginator->onFirstPage())
                   <span class="w-16 px-2 py-1 text-center rounded border bg-gray-100">
                        {!! __('Anterior') !!}
                    </span>
               @else
                   <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="w-16 px-2 py-1 text-center shadow rounded border bg-white">
                        {!! __('Anterior') !!}
                    </button>
               @endif
           </span>

           <div class="d-flex">
              @foreach($elements as $element)
                   @if(is_array($element))
                       @foreach($element as $page => $url)
                           @if($page == $paginator->currentPage())
                               <button class="mx-1 w-16 px-2 py-1 text-center rounded border shadow  bg-blue text-white cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</button>
                           @else
                               <button class="mx-1 w-16 px-2 py-1 text-center rounded border shadow  bg-white cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</button>
                           @endif
                       @endforeach
                   @endif
               @endforeach
           </div>

           <span>
                {{-- Next Page Link --}}
               @if ($paginator->hasMorePages())
                   <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="w-16 px-2 py-1 text-center shadow rounded border bg-white">
                        {!! __('Próximo') !!}
                    </button>
               @else
                   <span class="w-16 px-2 py-1 text-center rounded border bg-gray-100">
                        {!! __('Próximo') !!}
                    </span>
               @endif
            </span>
       </div>
@endif
