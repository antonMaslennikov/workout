@extends('layout.admin')

@section('title', isset($a) ? 'Редактировать упражнение' : 'Новое упражнение')

@section('content')

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">
            {{ isset($a) ? 'Редактировать упражнение' : 'Новое упражнение' }}
        </h3>

        <div class="mt-8">
            <form enctype="multipart/form-data" class="space-y-5 mt-5" method="post" action="{{ isset($a) ? route('admin.activities.update', $a->id) : route('admin.activities.store') }}">

                @csrf

                @if(isset($a))
                    @method('PUT')
                @endif

                <label>Название</label>
                <input name="name" type="text" value="{{ isset($a) ? $a->name : '' }}" class="w-full h-12 border border-gray-800 rounded px-3 @error('name') border-red-500 @enderror" placeholder="Название" />

                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label>Описание</label>
                <textarea name="description" rows="6" class="w-full border border-gray-800 rounded px-3 @error('description') border-red-500 @enderror" placeholder="Описание">{{ isset($a) ? $a->description : '' }}</textarea>

                @error('description')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label>Часть тела</label>
                <select name="body_part" class="w-full h-12 border border-gray-800 rounded px-3 @error('body_part') border-red-500 @enderror">
                    <option value="">-</option>
                    @foreach($body_parts AS $bp)
                        <option value="{{ $bp['id']  }}" {{ isset($a) && $bp['id'] == $a->body_part ? 'selected="selected"' : '' }}>{{ $bp['name']  }}</option>
                    @endforeach
                </select>

                @error('body_part')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
