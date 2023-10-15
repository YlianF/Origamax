@vite(['resources/css/post.css', 'resources/js/app.js'])

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="title">{{ $post->title }}</h1>

                    
                    @if ($post->link !== null)
                        <a href="{{ $post->link }}" class="link" title="voir le lien" >Voir le tutoriel</a>
                    @endif


                    <p>Par {{ $post->user->name }}</p>

                    <textarea readonly class="content">{{ $post->content }}</textarea>

                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="editPost" title="modifier le post" >Modifier le post</a>
                    @endcan

                    @can('delete', $post)
                        <form method="POST" action="{{ route('post.destroy', $post) }}" >
                            @csrf
                            @method("DELETE")
                            <input type="submit" class="deletePost" value="Supprimer le post" >
                        </form>
                    @endcan

                    
                    
                    

                    <div class="comments">
                        
                        <a class="commenter" href="{{ route('comment.create', $post) }}" title="Commenter" >Commenter</a>
                        <p>Commentaires</p>
                        @if($post->comments->count() > 0)

                            @foreach ($post->comments as $comment)

                                <div class="comment">
                                    <p class="commenteur">{{ $comment->user->name }}</p>
                                    <textarea readonly class="comment-content">{{ $comment->content }}</textarea>
                                </div>

                                @can('delete', $comment)
                                    <form method="POST" action="{{ route('comment.destroy', [$post, $comment]) }}" >
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" class="deleteComment" value="Supprimer le commentaire" >
                                    </form>
                                @endcan

                            @endforeach

                        @else

                            <p>Pas de commentaires pour l'instant...</p>

                        @endif
                    </div>
                    <p><a href="{{ route('posts.index') }}" title="Retourner aux articles" >Retourner aux posts</a></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>