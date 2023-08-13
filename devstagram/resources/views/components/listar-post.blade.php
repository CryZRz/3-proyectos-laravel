<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-col-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{route("post.show", ["post" => $post, "user" => $post->user])}}">
                        <img src="{{asset("uploads")."/".$post->imagen}}" alt="imagen del post {{$post->titulo}}"/>
                    </a>
                </div>
            @endforeach
        </div>
        <div>
            {{$posts->links("pagination::tailwind")}}
        </div>
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones</p>
    @endif
</div>