@vite(['resources/css/post.css', 'resources/js/app.js'])

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="title">{{ $post->title }}</h1>

                    <a href="{{ $post->link }}" class="link" title="voir le lien" >Voir le tutoriel</a>

                    <textarea class="content">{{ $post->content }}</textarea>

                    <p><a href="{{ route('posts.index') }}" title="Retourner aux articles" >Retourner aux posts</a></p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>