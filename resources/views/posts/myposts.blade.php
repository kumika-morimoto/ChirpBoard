<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            自分の投稿
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6">
        @foreach($posts as $post)
        <div class="border-b py-4">
            <p class="text-gray-700">{{$post->body}}</p>
            <p class="text-sm text-gray-500">
                {{$post->created_at->diffForHumans()}}</p>

            {{--★トグルボタン＋カウント--}}
            <form action="{{route('posts.toggle',$post->id)}}" method="POST">
                @csrf
                <button type="submit">
                    @if($post->likes->contains('user_id',Auth::id()))
                    ★
                    @else
                    ☆
                    @endif
                    {{$post->likes->count()}}
                </button>
            </form>

            @if($post->user_id ===Auth::id())
                <div class="flex gap-3 mt-2">
                    <a href="{{route('posts.edit',$post->id)}}" class="text-blue-500">編集</a>

                    <form method="POST" action="{{route('posts.destroy',$post->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">削除</button>
                    </form>
                </div>
            @endif
        </div>
        @endforeach
        <div class="mt-4">
            {{$posts->links('pagination::simple-tailwind')}}
        </div>
    </div>
</x-app-layout>