{{-- resources/views/components/category.blade.php --}}
@if (count($categories) > 0)
    <ul>
        @foreach ($categories as $category)
            <li>
                {{ $category->name }}
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Изменить</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?');">Удалить</button>
                </form>
                @if (count($category->children) > 0)
                    @include('components.category', ['categories' => $category->children])
                @endif
            </li>
        @endforeach
    </ul>
@endif