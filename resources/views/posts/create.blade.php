<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            新規投稿
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{route('posts.store')}}">
            @csrf

            <textarea
                name="body"
                class="w-full border rounded p-2"
                rows="4"
                placeholder="いまどうしてる？">{{old('body')}}</textarea>

            @error('body')
            <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
            
            <button
                type="submit"
                class="mt-3 bg-blue-500 text-white px-4 py-2 rounded">
                投稿する
            </button>
        </form>
    </div>
</x-app-layout>