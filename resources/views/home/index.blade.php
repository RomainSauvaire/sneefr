@extends('layouts.master')

@push('style')
    <style>
        .shop__pub {
            background-color: #ff3d7b;
            background-image: url('{{ url("/img/shop-background.png") }}');
            background-repeat: no-repeat;
            background-position: center bottom;
            background-size: 100%;
            height: 380px;
            padding-top: 50px;
        }
    </style>
@endpush

@section('content')

    <div class="container">
        <div class="row">
            {{-- trending shop --}}
            <div class="col-sm-9">

                <div class="home__header">
                    <img class="img-responsive home__header__img" src="{{ url('/img/img-header.png') }}" alt="" >
                    <div class="home__header__content">
                        <h1 class="home__header__title">Buy from great local trusted shops in your city, all in one place</h1>
                        <p class="home__header__dscription">Search what you want, sneefR shows you the shops around you that sell what you’re looking for at the best price. Buy directly online and get delivered or go instore to pickup your item for free.</p>
                        <span class="home__header__locale"><i class="fa fa-map-marker"></i> Los Angeles - More city to come</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="home__section home__section--padding">
                            <h4 class="home__section__title">@lang('common.trending_shops') <span class="home__section__description">@lang('common.trending_description')</span></h4>
                            <a href="" class="btn btn-default-o pull-right">@lang('button.see_all')</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($topShops as $shop)
                        <div class="col-sm-6">
                            @include('partials.card', ['item' => $shop,'multiple' => true])
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- end trending shop --}}
            {{-- best seller --}}
            <div class="col-sm-3 ">
                <div class="box__panel box__panel--padding">
                    <div class="home__section">
                        <h4 class="home__section__title home__section__title--small">Best Seller</h4>
                    </div>
                    <div class="row">
                        @foreach($bestSellers as $item)
                            <div class="card__box__footer">
                                <div class="card__box__avatar">
                                    <a href="{{ route('ad.show', $item) }}">
                                        <img class="card__box__avatar__img" src="{{ $item->images('60x60', true)[0] }}" alt="">
                                    </a>
                                </div>
                                <div class="card__box__description">
                                    <span class="text-indent">{{ $item->present()->title() }}</span>
                                    <div>
                                        <span class="text-primary">{!! $item->present()->price() !!}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <a class="btn btn-default-o" href="#">@lang('button.see_more')</a>
                    </div>
                </div>
            </div>
            {{-- end best seller --}}
        </div>

        <div class="row">

            <div class="col-sm-12">
                <div class="home__section home__section--padding">
                    <h4 class="home__section__title">@lang('common.browse_by_category')</h4>
                </div>
            </div>

            <div class="row">
                {{-- categpries --}}
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="home__categories">
                                <li>
                                    <a href="#">All</a>
                                </li>
                                <li>
                                    <a href="#">Véhicles</a>
                                </li>
                                <li class="home__categories__item--active">
                                    <a href="#">Multimedia</a>
                                </li>
                                <ul class="home__categories home__categories--child">
                                    <li class="home__categories__item--active">
                                        <i class="fa fa-check color-pink home__categories__item--checked"></i>
                                        <a href="#">Computers</a>
                                    </li>
                                    <li>
                                        <a href="#">Video games & Consoles </a>
                                    </li>
                                    <li>
                                        <a href="#">Home entertainement</a>
                                    </li>
                                </ul>

                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li>
                                    <a href="#">Fashion</a>
                                </li>
                                <li>
                                    <a href="#">Jewelry</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- ads by categorie  --}}
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-12">
                            @foreach($shopsByCategory as $ad)
                                <div class="col-sm-4">
                                    @include('partials.card', ['item' => $ad, 'multiple' => false])
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-12" style="padding-right: 30px;">
                            <a href="#" class="btn btn-default-o pull-right">@lang('button.see_more')</a>
                        </div>
                    </div>

                </div>
                {{-- end ads by categorie  --}}
            </div>
        </div>

    </div>

    <div class="space"></div>

    <div class="shop__pub text-center color-white">
        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <h1 class="shop__pub__title">@lang('common.pub.title')</h1>
                <p class="shop__pub__description">
                    @lang('common.pub.description')
                </p>
                <a href="{{ route('pricing') }}" class="btn btn-blue text-uppcase">@lang('button.learn_more')</a>
            </div>
        </div>
    </div>

@endsection