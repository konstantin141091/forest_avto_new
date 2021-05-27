@extends('layouts.app_admin')
@section('page-title', 'Админ-панель сайта')

@section('content')
    <div class="wrapper">
        <h1>Админка сайта</h1>
        <ul>
            <li><a href="{{ route('admin.order.index') }}">Просмотр заказов</a></li>
            <li><a href="#">Просто ссылка</a></li>
            <li><a href="#">Просто ссылка</a></li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Выйти</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
@endsection
