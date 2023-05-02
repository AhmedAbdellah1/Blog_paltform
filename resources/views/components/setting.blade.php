@props(['heading'])
<section class="px-6 w-4xl py-8 ">
    <h1 class="text-2xl font-bold mb-4 pb-2 border-b">{{ $heading }}</h1>
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
        <main class="flex-1">
            <form action="/admin/posts" method="POST" enctype="multipart/form-data"
                class=" bg-gray-50 shadow-md rounded-xl px-8 pt-6 pb-8 mb-4 max-w-2xl mx-auto">
                @csrf

                <div class="mb-4">
                    <label for="slug" class="block text-gray-700 font-bold mb-2">Slug</label>
                    <input type="text" name="slug" id="slug"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('slug') }}" required>
                    @error('slug')
                        <p class="text-center text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-center text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="excerpt" class="block text-gray-700 font-bold mb-2">Excerpt</label>
                    <input type="text" name="excerpt" id="excerpt"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('excerpt') }}"required>
                    @error('excerpt')
                        <p class="text-center text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="body" class="block text-gray-700 font-bold mb-2">Body</label>
                    <textarea name="body" id="body"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="5" required>
                        {{ old('body') }}
                    </textarea>
                </div>

                <div class="mb-4">
                    <label for="thumbnail" class="block text-gray-700 font-bold mb-2">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('excerpt') }}"required>
                    @error('excerpt')
                        <p class="text-center text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select name="category_id" id="category_id"
                        class="shadow appearance-none border rounded w-40 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ ucwords($category->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create Post
                    </button>
                </div>
            </form>

        </main>
    </div>

</section>
