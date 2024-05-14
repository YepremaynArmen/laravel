{{-- resources/views/photo/index.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Галерея фотографий</h1>
    <a href="{{ route('photos.create') }}" class="btn btn-primary">Добавить новую фотографию</a>
    <div class="row">
        @foreach ($photos as $photo)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('storage/'.$photo->image_path) }}" alt="{{ $photo->title }}" class="bd-placeholder-img card-img-top">
                    <div class="card-body">
                        <p class="card-text">{{ $photo->title }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('photos.show', $photo) }}" class="btn btn-sm btn-outline-secondary">Просмотр</a>
                                <a href="{{ route('photos.edit', $photo) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Удалить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Пагинация -->
    <div class="row">
        <div class="col-12">
            {{ $photos->links() }}
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Добавьте здесь любой специфический JavaScript, если это необходимо
    });
</script>
@endsection