<div>
    @isset($jsPath)
        <script>{!! file_get_contents($jsPath) !!}</script>
    @endisset
    @isset($cssPath)
        <style>{!! file_get_contents($cssPath) !!}</style>
    @endisset

    <div x-data="LivewireUISpotlight({ componentId: '{{ $this->id }}', placeholder: '{{ trans('general.search') }}', commands: {{ $commands }} })"
         x-init="init(), setTimeout(() => $refs.livewireSpotlight.classList.remove('hidden'), $refs.livewireSpotlight.classList.add('flex'), 100)"
         x-ref="livewireSpotlight"
         x-show="isOpen"
         @open-spotlight-modal.window="isOpen = true"
         x-cloak
         @foreach(config('livewire-ui-spotlight.shortcuts') as $key)
            @keydown.window.prevent.cmd.{{ $key }}="toggleOpen()"
            @keydown.window.prevent.ctrl.{{ $key }}="toggleOpen()"
         @endforeach
         @keydown.window.escape="isOpen = false"
         @toggle-spotlight.window="toggleOpen()"
         class="fixed z-10 px-4 pt-16 items-start justify-center inset-0 sm:pt-24 hidden">
        <div x-show="isOpen" @click="isOpen = false" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 bg-opacity-25 transition-opacity"></div>
        </div>

        <div x-show="isOpen" x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="mx-auto w-5/12 transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
            <div class="relative">
                <div class="absolute h-full left-4 flex items-center">
                    <span class="material-icons pointer-events-none absolute top-3 text-2xl text-gray-400">search</span>
                </div>
                <input @keydown.tab.prevent="" @keydown.prevent.stop.enter="go()" @keydown.prevent.arrow-up="selectUp()"
                       @keydown.prevent.arrow-down="selectDown()" x-ref="input" x-model="input"
                       type="text"
                       style="caret-color: #6b7280; border: 0 !important;"
                       class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-800 placeholder-gray-400 focus:ring-0 sm:text-sm"
                       x-bind:placeholder="inputPlaceholder">
            </div>
            <div class="border-t border-gray-500" x-show="filteredItems().length > 0">
                <ul x-ref="results" style="max-height: 285px;" class="scroll-py-2 divide-y divide-gray-100 overflow-y-auto">
                    <!-- <template x-for="(item, i) in filteredItems()" :key>
                        <li>
                            <button x-on:click="" class="block w-full px-6 py-3 text-left"
                                    :class="{ 'bg-gray-700': selected === i, 'hover:bg-gray-800': selected !== i }">
                                <span x-text="item.name"
                                      :class="{'text-gray-300': selected !== i, 'text-white': selected === i }"></span>
                                <span x-text="item[0].item.description" class="ml-1"
                                      :class="{'text-gray-500': selected !== i, 'text-gray-400': selected === i }"></span>
                            </button>
                        </li>
                    </template> -->
                    <li class="p-2">
                        <ul class="text-sm text-gray-700">
                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group hover:bg-purple">
                                <span class="material-icons text-gray-400 text-xl group-hover:text-white">description</span>
                                <span class="ml-3 flex-auto truncate group-hover:text-white">
                                    Invoice
                                </span>
                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400 group-hover:text-white">
                                    <kbd class="font-sans">⌘</kbd>
                                    <kbd class="font-sans">Q</kbd>
                                </span>
                            </li>

                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group hover:bg-purple">
                                <span class="material-icons text-gray-400 text-xl group-hover:text-white">request_quote</span>
                                <span class="ml-3 flex-auto truncate group-hover:text-white">
                                    Income
                                </span>
                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400 group-hover:text-white">
                                    <kbd class="font-sans">⌘</kbd>
                                    <kbd class="font-sans">R</kbd>
                                </span>
                            </li>

                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group hover:bg-purple">
                                <span class="material-icons text-gray-400 text-xl group-hover:text-white">person</span>
                                <span class="ml-3 flex-auto truncate group-hover:text-white">
                                    Customer
                                </span>
                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400 group-hover:text-white">
                                    <kbd class="font-sans">⌘</kbd>
                                    <kbd class="font-sans">C</kbd>
                                </span>
                            </li>

                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group hover:bg-purple">
                                <span class="material-icons text-gray-400 text-xl group-hover:text-white">file_open</span>
                                <span class="ml-3 flex-auto truncate group-hover:text-white">
                                    Bill
                                </span>
                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400 group-hover:text-white">
                                    <kbd class="font-sans">⌘</kbd>
                                    <kbd class="font-sans">B</kbd>
                                </span>
                            </li>

                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group hover:bg-purple">
                                <span class="material-icons text-gray-400 text-xl group-hover:text-white">paid</span>
                                <span class="ml-3 flex-auto truncate group-hover:text-white">
                                    Expense
                                </span>
                                <span class="ml-3 flex-none text-xs font-semibold text-gray-400 group-hover:text-white">
                                    <kbd class="font-sans">⌘</kbd>
                                    <kbd class="font-sans">P</kbd>
                                </span>
                            </li>

                            <li class="flex cursor-default select-none items-center rounded-md px-3 py-2 group hover:bg-purple">
                                <a href="/">
                                    <span class="material-icons text-gray-400 text-xl group-hover:text-white">engineering</span>
                                    <span class="ml-3 flex-auto truncate group-hover:text-white">
                                        Vendor
                                    </span>
                                    <span class="ml-3 flex-none text-xs font-semibold text-gray-400 group-hover:text-white">
                                        <kbd class="font-sans">⌘</kbd>
                                        <kbd class="font-sans">V</kbd>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Empty state, show/hide based on command palette state. -->
            <!-- <div x-show="filteredItems().length == 0" class="py-14 px-6 text-center sm:px-14">
                <span class="material-icons-outlined text-gray-500">folder</span>
                <p class="mt-4 text-sm text-gray-900">We couldn't find any projects with that term. Please try again.</p>
            </div> -->
        </div>
    </div>
</div>
