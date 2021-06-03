@extends('layouts.app')
@section('page-title', 'Портал автозапчастей')
@section('main-screen', 'main-screen')

@section('header')
    @parent
    <h1 class="main-offer">Лучшие предложения автозапчастей для иномарок</h1>
    <div class="header__form">
        <form action="{{ route('search.artikul') }}" method="post">
            @csrf
            <input type="text" placeholder="Введите артикул" name="artikul" value="{{ old('artikul') }}">
            <button type="submit">Подобрать запчасти</button>
        </form>
        @if($errors->has('artikul'))
            <div class="alert alert-danger" role="alert">
                @foreach($errors->get('artikul') as $err)
                    {{ $err }}
                @endforeach
            </div>
        @endif

        <form action="{{ route('search.car') }}" method="post">
            @csrf
            <input type="text" placeholder="Введите VIN или номер кузова" name="search" value="{{ old('search') }}">
            <button type="submit">Подобрать запчасти</button>
        </form>
        @if($errors->has('search'))
            <div class="alert alert-danger" role="alert">
                @foreach($errors->get('search') as $err)
                    {{ $err }}
                @endforeach
            </div>
        @endif




{{--        <form action="{{ route('search.frame') }}" method="post">--}}
{{--            @csrf--}}
{{--            <input type="text" placeholder="Введите Frame" name="vin" value="{{ old('frame') }}">--}}
{{--            <button type="submit">Подобрать запчасти</button>--}}
{{--        </form>--}}
{{--        @if($errors->has('frame'))--}}
{{--            <div class="alert alert-danger" role="alert">--}}
{{--                @foreach($errors->get('frame') as $err)--}}
{{--                    {{ $err }}--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
        {{--        ошибки валидации--}}
{{--        TODO нужно будет внести в верстку и написать стили, пока как заглушка--}}


    </div>
    <ul class="header__advs advs-list">
        <li class="advs-list__item">
            <img src="/storage/img/delivery-box.svg" alt="Доставка по всей России" class="advs-list__img">
            <span class="advs-list__text">Доставка по <br/>всей России</span>
        </li>
        <li class="advs-list__item">
            <img src="/storage/img/badge.svg" alt="Более 30 топовых брендов" class="advs-list__img">
            <span class="advs-list__text">Более 30 топовых брендов</span>
        </li>
        <li class="advs-list__item">
            <img src="/storage/img/main-map.svg" alt="Отслеживание заказа" class="advs-list__img">
            <span class="advs-list__text">Отслеживание заказа</span>
        </li>
        <li class="advs-list__item">
            <img src="/storage/img/wallet.svg" alt="Удобный способ оплаты" class="advs-list__img">
            <span class="advs-list__text">Удобный способ оплаты</span>
        </li>
    </ul>
@endsection

@section('content')
    <main>
        <div class="news-block">
            <div class="wrapper">
                <header class="news-block__header">
                    <div class="news-block__title">Наши новости</div>
                    <a href="#" class="news-block__all-news">Все новости <i class="icon-font icon-all-news"></i></a>
                </header>

                <ul class="news-list">
                    <li class="news-list__item">
                        <span class="news-list__date"><img src="/storage/img/Calendar.svg" alt="Дата новости"> 6 декабря 2020</span>
                        <a href="#">
                            <h5 class="news-list__title">Информационное письмо MAHLE о смене упаковки фильтров</h5>
                            <i class="icon-font icon-arrow"></i>
                        </a>
                    </li>

                    <li class="news-list__item">
                        <span class="news-list__date"><img src="/storage/img/Calendar.svg" alt="Дата новости"> 6 декабря 2020</span>
                        <a href="#">
                            <h5 class="news-list__title">Информационное письмо MAHLE о смене упаковки фильтров</h5>
                            <i class="icon-font icon-arrow"></i>
                        </a>
                    </li>

                    <li class="news-list__item">
                        <span class="news-list__date"><img src="/storage/img/Calendar.svg" alt="Дата новости"> 6 декабря 2020</span>
                        <a href="#">
                            <h5 class="news-list__title">Информационное письмо MAHLE о смене упаковки фильтров</h5>
                            <i class="icon-font icon-arrow"></i>
                        </a>
                    </li>

                    <li class="news-list__item">
                        <span class="news-list__date"><img src="/storage/img/Calendar.svg" alt="Дата новости"> 6 декабря 2020</span>
                        <a href="#">
                            <h5 class="news-list__title">Информационное письмо MAHLE о смене упаковки фильтров</h5>
                            <i class="icon-font icon-arrow"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="need-consult">
            <div class="wrapper need-consult__wrapper">
                <div class="need-consult__text">
                    <h4 class="need-consult__title">Нужна консультация?</h4>
                    <span class="need-consult__subtitle">Оставь номер телефона, перезвоним за 10 минут</span>
                </div>
                <div class="need-consult__form">
                    <form>
                        <div class="form-block">
                            <input type="text" placeholder="Ваш телефон">
                        </div>
                        <button type="submit">Получить консультацию</button>
                        <span class="agreement">Нажимая на кнопку "Получить консультацию", вы соглашаетесь с <a href="#">политикой конфиденциальности</a></span>
                    </form>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="main-about">
                <div class="main-about__text">
                    <h4 class="main-about__title">
                        Большой ассортимент запчастей для иномарок
                    </h4>
                    <p class="main-about__desc">Автозапчасти – один из ведущих поставщиков автозапчастей в России. Мы напрямую сотрудничаем с импортерами, у нас можно заказать любые комплектующие для автомобилей и получить их в течение 24 часов. Для подбора нужной детали на сайте можно  оспользоваться поиском, отметив номер в поисковой строке или выбрать онлайн по марке машины, указав модель и модификацию.</p>
                    <a href="#" class="main-about__link">Читать продолжение</a>
                </div>
                <div class="main-about__photo">
                    <img src="/storage/img/about.jpg" alt="О нас">
                </div>
            </div>
        </div>

        <div class="have-questions">
            <div class="wrapper">
                <span class="have-questions__text">Остались вопросы?</span>
                <span class="have-questions__phone">+7 925 755 53 59</span>
                <a href="#" class="have-questions__link"><i class="icon-font icon-phone"></i> Заказать звонок</a>
            </div>
        </div>
    </main>
@endsection

