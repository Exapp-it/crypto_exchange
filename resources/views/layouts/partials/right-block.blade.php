<div
    class="md:flex items-center md:space-x-6 lg:block lg:space-x-0 w-full lg:w-1/3 px-2 border-t border-gray-300 pt-5">
    <div
        class="w-full md:1/2 lg:w-full mb-2 bg-transparent border border-green-400 rounded-lg  p-10 hover:shadow-xl transition-all duration-300">
        <div class="flex justify-between">
            <h2 class="title text-gray-600">{{__('Links')}}</h2>
            @auth()
                <a href="{{route('link.add')}}" class="text-green-400 text-lg font-semibold">{{__('Buy a link for ')}}
                    <b>2</b> <span class="text-xs">₽</span>
                </a>
            @endauth
            @guest()
                <span @click="openLoginModal" class="text-green-400 cursor-pointer text-lg font-semibold">{{__('Buy a link for ')}}
                    <b>2</b> <span class="text-xs">₽</span>
                </span>
            @endguest
        </div>
        @isset($links)
            <ul x-data="Link()">
                @foreach($links as $link)
                    <li class="px-1 py-4 border-y border-transparent hover:border-gray-300 transition-all duration-300">
                        <a :class="{
    'flex items-center pr-2 text-gray-600 text-sm hover:text-green-400 transition-all duration-300': !'{{$link->color}}',
    'flex items-center pr-2 text-{{$link->color}}-600 text-sm hover:text-green-400 transition-all duration-300': '{{$link->color}}',
}"
                           href="{{$link->url}}" target="_blank"
                           @click="linkClick('{{route('link.click', $link)}}')"
                        >
                            <span class="inline-block mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                </svg>
                            </span>
                            {{__($link->title)}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endisset
        <div class="mt-3 flex justify-center">
            @auth()
                <a class="text-sm hover:text-green-400 transition-all duration-300"
                   href="{{route('link.add')}}">{{__('Add link')}}
                </a>
            @endauth
            @guest()
                <span class="text-sm cursor-pointer hover:text-green-400 transition-all duration-300"
                      @click="openLoginModal">{{__('Add link')}}
                </span>
            @endguest

        </div>
    </div>
    <div class="w-full md:1/2 lg:w-full my-5">
        <a class="flex items-center justify-center" href="#">
            <img class="drop-shadow-2xl rounded-lg" src="https://webasic.ru/gifb/200300/12.gif" alt="">
        </a>
    </div>
</div>
