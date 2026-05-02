<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
        投稿の編集
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-6">
        <form action="{{route('posts.update', $post->id)}}" method="POST">
            @csrf
            @method('PATCH')
            
            <textarea
            name="body"
            rows="4"
            class="w-full border rounded p-2">{{old('body', $post->body)}}</textarea>

            @error('body')
            <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror

            <button
                type="submit"
                class="mt-3 bg-blue-500 text-white px-4 py-2 rounded">
                更新
            </button>
        </form>
    </div>
</x-app-layout>