<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">                
                    <h1>Editer un post</h1>

                    <!-- Si nous avons un Post $post -->
                    @if (isset($post))

                    <!-- Le formulaire est géré par la route "posts.update" -->
                    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" >

                        <!-- <input type="hidden" name="_method" value="PUT"> -->
                        @method('PUT')

                    @else

                    <!-- Le formulaire est géré par la route "posts.store" -->
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" >

                    @endif

                        <!-- Le token CSRF -->
                        @csrf

                        <p>
                            <label for="title" >Titre</label><br/>

                            <!-- S'il y a un $post->title, on complète la valeur de l'input -->
                            <input type="text" name="title" value="{{ isset($post->title) ? $post->title : old('title') }}"  id="title" placeholder="Le titre du post" >

                            <!-- Le message d'erreur pour "title" -->
                            @error("title")
                            <div>{{ $message }}</div>
                            @enderror
                        </p>


                        <p>
                            <label for="link" >Lien</label><br/>

                            <!-- S'il y a un $post->link, on complète la valeur de l'input -->
                            <input type="text" name="link" value="{{ isset($post->link) ? $post->link : old('link') }}"  id="link" placeholder="Un lien vers un tutoriel ?" >

                            <!-- Le message d'erreur pour "link" -->
                            @error("link")
                            <div>{{ $message }}</div>
                            @enderror
                        </p>
                        <p>
                            <label for="content" >Contenu</label><br/>

                            <!-- S'il y a un $post->content, on complète la valeur du textarea -->
                            <textarea name="content" id="content" lang="fr" rows="10" cols="50" placeholder="Le contenu du post" >{{ isset($post->content) ? $post->content : old('content') }}</textarea>

                            <!-- Le message d'erreur pour "content" -->
                            @error("content")
                            <div>{{ $message }}</div>
                            @enderror
                        </p>

                        <label>Publier
                            <input type="radio" name="isVisible" value="true" />
                        </label> 
                        <br>
                        <label>Ne pas publier
                            <input type="radio" name="isVisible" value="false" />
                        </label> 

                        <br>
                        <br>
                        <br>

                        <input type="submit" name="valider" value="Valider" >

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>