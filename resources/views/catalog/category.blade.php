<!-- resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', $pageTitle)
@section('content')

    <div class="container-fluid">
    <div class="row">
    <!-- Левая колонка: меню -->
        <nav class="col-md-3 sidebar bg-light pt-3">
        @include('components.sidebarMenu', [
            'sideBarData' => $sideBarData, 
            'categories' => $categories, 
            'locale' => $locale
        ])
        </nav>

        <!-- Основной контент -->
        <main class="col-md-9 pt-3">
        <!-- Первый блок: фото и описание категории -->
        <div class="mb-4">
            <img src="https://via.placeholder.com/800x300?text=Фото+категории" alt="Фото категории" class="category-photo mb-3" />
            <h2>Название категории</h2>
            <p>Здесь краткое описание категории товаров. Можно написать интересные детали, преимущества или информацию, полезную покупателям.</p>
        </div>

        <!-- Второй блок: карточки товаров -->
        <div>
            <div class="row">
            <!-- Будет 3 ряда по 3 карточки -->
            <!-- Ряд 1 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+1" class="card-img-top" alt="Товар 1">
                <div class="card-body">
                    <h5 class="card-title">Товар 1</h5>
                    <p class="card-text">Краткое описание товара 1.</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+2" class="card-img-top" alt="Товар 2">
                <div class="card-body">
                    <h5 class="card-title">Товар 2</h5>
                    <p class="card-text">Краткое описание товара 2.</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+3" class="card-img-top" alt="Товар 3">
                <div class="card-body">
                    <h5 class="card-title">Товар 3</h5>
                    <p class="card-text">Краткое описание товара 3.</p>
                </div>
                </div>
            </div>

            <!-- Ряд 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+4" class="card-img-top" alt="Товар 4">
                <div class="card-body">
                    <h5 class="card-title">Товар 4</h5>
                    <p class="card-text">Краткое описание товара 4.</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+5" class="card-img-top" alt="Товар 5">
                <div class="card-body">
                    <h5 class="card-title">Товар 5</h5>
                    <p class="card-text">Краткое описание товара 5.</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+6" class="card-img-top" alt="Товар 6">
                <div class="card-body">
                    <h5 class="card-title">Товар 6</h5>
                    <p class="card-text">Краткое описание товара 6.</p>
                </div>
                </div>
            </div>

            <!-- Ряд 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+7" class="card-img-top" alt="Товар 7">
                <div class="card-body">
                    <h5 class="card-title">Товар 7</h5>
                    <p class="card-text">Краткое описание товара 7.</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+8" class="card-img-top" alt="Товар 8">
                <div class="card-body">
                    <h5 class="card-title">Товар 8</h5>
                    <p class="card-text">Краткое описание товара 8.</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                <img src="https://via.placeholder.com/300x200?text=Товар+9" class="card-img-top" alt="Товар 9">
                <div class="card-body">
                    <h5 class="card-title">Товар 9</h5>
                    <p class="card-text">Краткое описание товара 9.</p>
                </div>
                </div>
            </div>
            </div>
        </div>

        </main>
    </div>
    </div>

@endsection