<header class="max-w-xl mx-auto mt-20 text-center">

    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Laravel From Scratch</span> News
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">

        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl">

            <div x-data="{ open: false }">

                <button @click="open = ! open"
                    class=" lg:inline-flex flex py-2 pl-3 pr-9 text-sm font-semibold w-32 text-left">

                    {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

                    <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"
                        height="22" viewBox="0 0 22 22">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path fill="#222"
                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>
                </button>

                <div x-show="open" class="py-1  absolute bg-gray-100 w-full rounded-b-xl z-50 overflow-auto max-h-52"
                    style="display: none;">

                    <a href="/"
                        class="block text-left px-1  text-sm leading-6 hover:bg-blue-500 hover:text-white focus:bg-blue-500 focus:text-white">
                        All
                    </a>

                    @foreach ($categories as $category)
                        <a href="/?category={{ $category->slug }}&{{ http_build_query(['excerpt' => request('excerpt')]) }}"
                            class="block text-left px-1  text-sm leading-6
                        hover:bg-blue-500 hover:text-white focus:bg-blue-500 focus:text-white
                        {{ isset($currentCategory) && $currentCategory->is($category) ? 'bg-blue-500 text-white' : '' }}
                        ">
                            {{ ucwords($category->name) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="#">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="search" placeholder="Find something"
                    class="bg-transparent placeholder-black font-semibold text-sm" value="{{ request('search') }}">
            </form>
        </div>
    </div>
</header>
