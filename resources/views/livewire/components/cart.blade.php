<div class="sm:relative"
     x-data="{
         linesVisible: @entangle('linesVisible')
     }">
  <button class="grid w-16 h-16 transition border-l border-gray-100 lg:border-l-transparent hover:opacity-75"
          x-on:click="linesVisible = !linesVisible">
    <span class="sr-only">Cart</span>

    <span class="place-self-center">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
           stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
      </svg>
    </span>
  </button>

  <div
    class="absolute inset-x-0 top-auto z-50 w-screen max-w-sm px-6 py-8 mx-auto mt-4 bg-white border border-gray-100 shadow-xl sm:left-auto rounded-xl"
    x-show="linesVisible"
    x-on:click.away="linesVisible = false"
    x-transition
    x-cloak>
    <button class="absolute text-gray-500 transition-transform top-3 right-3 hover:scale-110"
            type="button"
            aria-label="Close"
            x-on:click="linesVisible = false">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="w-4 h-4"
           fill="none"
           viewBox="0 0 24 24"
           stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    <div>
      @if ($this->cart)
        @if ($lines)
          <div class="flow-root">
            <ul class="-my-4 overflow-y-auto divide-y divide-gray-100 max-h-96">
              @foreach ($lines as $index => $line)
                <li>
                  <div class="flex py-4"
                       wire:key="line_{{ $line['id'] }}">
                    <img class="object-cover w-16 h-16 rounded"
                         src="{{ $line['thumbnail'] }}" alt="">

                    <div class="flex-1 ml-4">
                      <p class="max-w-[20ch] text-sm font-medium">
                        {{ $line['description'] }}
                      </p>

                      <span class="block mt-1 text-xs text-gray-500">
                        {{ $line['identifier'] }} / {{ $line['options'] }}
                      </span>

                      <div class="flex items-center mt-2">
                        <label>
                          <input
                            class="w-16 p-2 text-xs transition-colors border border-gray-100 rounded-lg hover:border-gray-200"
                            type="number"
                            wire:model="lines.{{ $index }}.quantity"
                            wire:change="updateLines"
                            wire:keyup="updateLines"/>
                        </label>

                        <p class="ml-2 text-xs">
                          @ {{ $line['unit_price'] }}
                        </p>

                        <button
                          class="p-2 ml-auto text-gray-600 transition-colors rounded-lg hover:bg-gray-100 hover:text-gray-700"
                          type="button"
                          wire:click="removeLine('{{ $line['id'] }}')">
                          <svg xmlns="http://www.w3.org/2000/svg"
                               class="w-4 h-4"
                               fill="none"
                               viewBox="0 0 24 24"
                               stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>

                  @if ($errors->get('lines.' . $index . '.quantity'))
                    <div class="p-2 mb-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
                         role="alert">
                      @foreach ($errors->get('lines.' . $index . '.quantity') as $error)
                        {{ $error }}
                      @endforeach
                    </div>
                  @endif
                </li>
              @endforeach
            </ul>
          </div>
        @else
          <p class="py-4 text-sm font-medium text-center text-gray-500">
            Your cart is empty
          </p>
        @endif

        <dl class="flex flex-wrap pt-4 mt-6 text-sm border-t border-gray-100">
          <dt class="w-1/2 font-medium">
            Sub Total
          </dt>

          <dd class="w-1/2 text-right">
            {{ $this->cart->subTotal->formatted() }}
          </dd>
        </dl>
      @else
        <p class="py-4 text-sm font-medium text-center text-gray-500">
          Your cart is empty
        </p>
      @endif
    </div>

    @if ($this->cart)
      <div class="mt-4 space-y-4 text-center">
        <a class="block w-full p-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-500"
           href="{{ route('checkout.view') }}">
          Checkout
        </a>

        <a class="inline-block text-sm font-medium text-gray-600 underline hover:text-gray-500 hover:cursor-pointer"
           x-on:click="linesVisible = false">
          Continue Shopping
        </a>
      </div>
    @endif
  </div>
</div>
