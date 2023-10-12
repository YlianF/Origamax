@vite(['resources/css/posts.css', 'resources/js/app.js'])
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Tous les articles</h1>

                    <p>
                        <!-- Lien pour créer un nouvel article : "posts.create" -->
                        <a href="{{ route('posts.create') }}" title="Créer un article" >Créer un nouveau post</a>
                    </p>

                    <div>
                        @foreach ($posts as $post)
                        <div class="post">
                            <h1 class="title">{{ $post->title }}</h1>
                            
                            @if ($post->link !== "")
                            <a href="{{ $post->link }}" class="link" title="voir le lien" >Voir le tutoriel</a>
                            @endif

                            <p class="content">{{ \Illuminate\Support\Str::limit($post->content, 200, $end='...') }}</p>
                            
                            <a href="{{ route('posts.show', $post) }}" class="voirPost" title="Lire l'article" >Voir le post</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>