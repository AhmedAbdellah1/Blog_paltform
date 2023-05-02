@props(['comment'])

<article class="flex space-x-4 p-6 rounded-xl border border-gray-200 bg-gray-50">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/60?u={{ $comment->id }}" alt="" width="60" height="60"
            class="rounded-xl">
    </div>

    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{ $comment->author->name }}</h3>
            <p class="text-xs"> Posted: <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time></p>
        </header>
        <p>{{ $comment->body }}</p>
    </div>
</article>
