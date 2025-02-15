       <!-- Card -->
       <div class=" flex flex-col bg-blue-100 border-blue-300 border shadow-sm rounded-xl">
           <div class="p-4 md:p-5 flex gap-x-4">
               <div class="shrink-0 flex justify-center items-center size-14 bg-gray-100 rounded-lg dark:bg-neutral-800">
                   {{-- <svg class="shrink-0 size-8 text-blue-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg"
                       width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                       stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                       <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                       <circle cx="9" cy="7" r="4" />
                       <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                       <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                   </svg> --}}
                   {!! $icon !!}
               </div>

               <div class="grow">
                   <div class="flex items-center gap-x-2">
                       <p class="text-sm font-semibold uppercase tracking-wide text-gray-500 dark:text-neutral-500">
                        {{ $title }}
                       </p>
                       <div class="hs-tooltip">
                           <div class="hs-tooltip-toggle">
                               <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                   xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                   fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                   stroke-linejoin="round">
                                   <circle cx="12" cy="12" r="10" />
                                   <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                   <path d="M12 17h.01" />
                               </svg>
                               <span
                                   class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700"
                                   role="tooltip">
                                   {{ $hint }}
                               </span>
                           </div>
                       </div>
                   </div>
                   <div class="mt-1 flex items-center gap-x-2">
                       <h1 class="text-3xl font-bold text-gray-800 dark:text-neutral-200">
                        {{ $value }}
                       </h1>
                   </div>
               </div>
           </div>
       </div>
       <!-- End Card -->
