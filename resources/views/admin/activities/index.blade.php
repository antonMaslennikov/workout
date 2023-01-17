@extends('layout.admin')

@section('title', 'Упражнения')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Упражнения</h3>

        <div class="mt-8 mb-4">
            <a href="{{ route('admin.activities.create') }}" class="text-indigo-600 hover:text-indigo-900">Добавить</a>
        </div>

        <form action="{{ route('admin.activities.index') }}" method="get">

            <div class="row">
                <div class="col-4">
                    <label>Поиск</label>
                    <input type="text" name="search" class="w-full h-12 border border-gray-800 rounded px-3">
                </div>
                <div class="col-4">
                    <label>Часть тела</label>
                    <select name="body_part" class="w-full h-12 border border-gray-800 rounded px-3 @error('body_part') border-red-500 @enderror">
                        <option value="">-</option>
                        @foreach($body_parts AS $bp)
                            <option value="{{ $bp['id']  }}" {{ 1 == 2 ? 'selected="selected"' : '' }}>{{ $bp['name']  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </form>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Заголовок</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach($activities AS $a)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">{{ $a->name }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                @can('update-activitie', $a)
                                    <a href="{{ route('admin.activities.edit', $a->id) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                                @endcan

                                @can('delete-activitie', $a)
                                    <form action="{{ route('admin.activities.destroy', $a->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900">Удалить</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <div class="px-2 py-2">
                    {{ $activities->withQueryString()->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
