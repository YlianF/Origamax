<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">                
                    <h1>écrire un Commentaire</h1>


                    <form method="POST" action="{{ route('comment.store', $post) }}" enctype="multipart/form-data" >

                        <!-- Le token CSRF -->
                        @csrf


                        <p>
                            <label for="content" >Contenu</label><br/>

                            <!-- S'il y a un $post->content, on complète la valeur du textarea -->
                            <textarea name="content" id="content" lang="fr" rows="10" cols="50" placeholder="Le contenu du commentaire" >{{ isset($comment->content) ? $comment->content : old('content') }}</textarea>

                            <!-- Le message d'erreur pour "content" -->
                            @error("content")
                            <div>{{ $message }}</div>
                            @enderror
                        </p>

                        <input type="submit" name="valider" value="Valider" >

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>