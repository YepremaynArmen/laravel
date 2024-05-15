{{-- resources/views/photos/index.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Фотогалерея</h1>
    <a href="{{ route('photos.create') }}" class="btn btn-success mb-3">Добавить фото</a>
    <div class="row">
    @foreach($photos as $photo)
        <div class="col-md-4">
            <div class="thumbnail">
                <img src="{{ Storage::url('uploads/' . $photo->image_path) }}" alt="{{ $photo->title }}" style="width:100px">
                <div class="caption">
                    <h3>{{ $photo->title }}</h3>
                    {{-- ... --}}
                    @if($photo->category)
                        <p>Категория: {{ $photo->category->name }}</p>
                    @endif                    
                    <div class="actions">
                        <a href="{{ route('photos.edit', $photo->id) }}" title="Редактировать" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Вы уверены?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
        @endforeach
    </div>
    <!-- Пагинация -->
    {{ $photos->links() }}
</div>
@endsection                        