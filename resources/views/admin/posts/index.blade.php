@extends('/components/layout')
@section('content')
    <section class="px-6 w-4xl py-8 ">
        <h1 class=" text-2xl font-bold mb-4 pb-2 border-b">Manage Posts</h1>
        <div class="flex">
            <aside class="w-48">
                <h4 class="font-semibold mb-4">Links</h4>
                <ul>
                    <li>
                        <a class="{{ request()->is('admin/posts') ? 'text-blue-500' : ' ' }}" href="/admin/posts">
                            All Posts
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : ' ' }}"
                            href="/admin/posts/create">New Post
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <a href="/posts/{{ $post->slug }}">
                                                            {{ $post->title }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="/admin/posts/{{ $post->id }}/edit"
                                                    class="text-blue-500 hover:text-blue-600">Edit</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="/admin/posts/{{ $post->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-xs text-gray-400">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
