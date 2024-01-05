<div x-cloak x-show="showAlert" x-transition.duration.500ms class="top-0 right-0 fixed  mt-4 mr-4">
    <div role="alert" class="rounded-xl relative border border-gray-100 bg-white p-4 z-50">
        <div class="flex items-start py-3 gap-4">
            <span x-show="message.status === 'success'" class="text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>

            <span x-show="message.status === 'error'" class="text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                </svg>
            </span>

            <div class="flex-1">
                <strong class="block font-medium"
                        x-text="message.status"
                        x-class="{ 'text-green-600': message.status === 'success', 'text-red-600': message.status === 'error' }"
                ></strong>
                <p class="mt-1 text-sm text-gray-700" x-html="message.text"></p>
            </div>

            <button @click="closeAlert()" class="text-gray-500 transition hover:text-gray-600">
                <span class="sr-only">Dismiss popup</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>
