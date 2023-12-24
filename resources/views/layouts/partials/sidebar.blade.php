<div x-data="{ isFixed: false }" x-init="init">
    <div x-bind:class="{ 'fixed top-0': isFixed }" x-ref="scrollElement"
        class="bg-white shadow-lg rounded-xl w-full max-w-xs mt-10">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 transform flex items-center mb-10 py-8 px-6 rounded-t-lg">
            <img class="rounded-full w-20 h-20 ring-4 ring-opacity-20 ring-gray-200"
                src="https://randomuser.me/api/portraits/women/79.jpg" alt="Dr. Jessica James">
            <div class="ml-5">
                <h1 class="text-white tracking-wide text-lg">Dr. Jessica James</h1>
                <p class="text-gray-300 tracking-wider text-sm">Dermathologist</p>
            </div>
        </div>
        <button
            class="text-white capitalize text-sm bg-gradient-to-r from-blue-600 to-blue-700 inline-block rounded-md flex items-center py-2 pl-3 pr-4 shadow-md mx-auto tracking-wider mb-5"><svg
                class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg> add branch</button>

        <ul class="px-8 relative pb-5">
            <li class="flex items-center text-gray-900 text-md py-4"><span class="text-gray-400 mr-5"><svg
                        class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2">
                        </path>
                    </svg></span> Dashboard</li>
            <li class="flex items-center text-gray-900 text-md py-4"><span class="text-gray-400 mr-5"><svg
                        class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg></span> Post sessions</li>
            <div class="bg-blue-600 w-1 h-14 absolute left-0" style="bottom:8.235rem;"></div>
            <li class="flex items-center text-gray-900 text-md py-4 text-blue-600"><span class="text-gray-400 mr-5"><svg
                        class="w-6 h-6 text-blue-600" fill="#5046e5" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg></span> Live sessions</li>
            <li class="flex items-center text-gray-900 text-md py-4"><span class="text-gray-400 mr-5"><svg
                        class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg></span> Messages</li>
            <li class="flex items-center text-gray-900 text-md py-4"><span class="text-gray-400 mr-5"><svg
                        class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg></span> Library</li>
        </ul>
    </div>
</div>
<script>
    function init() {
        // Получаем элемент, который мы хотим отслеживать
        const scrollElement = this.$refs.scrollElement;

        // Получаем начальное положение элемента относительно верхней границы документа
        const elementOffset = scrollElement.offsetTop;

        // Обрабатываем событие прокрутки
        window.addEventListener('scroll', () => {
            // Получаем текущую позицию прокрутки
            const scrollPosition = window.scrollY;

            // Проверяем, достигли ли мы элемента
            this.isFixed = scrollPosition >= elementOffset;
        });
    }
</script>
