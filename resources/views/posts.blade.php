@extends('/components/layout')

@section('content')

    @include('_post-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        {{-- this for flash message whan create naw user --}}
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
                class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($posts->count())

            <x-post-featured-card :post="$posts[0]" />
            @if ($posts->count() > 1)
                <div class="lg:grid lg:grid-cols-6">

                    @foreach ($posts->skip(1) as $post)
                        <x-post-card :post="$post" class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}" />
                    @endforeach
                </div>
            @endif
            {{ $posts->links() }}
        @else
            <p class="text-center">No Posts yat. Plaese Check back Later.</p>

        @endif
    </main>
@endsection
