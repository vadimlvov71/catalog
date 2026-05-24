@extends('default')

@section('content')

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            /*display: flex;*/
        }
        .sidebar {
           /* width: 20%;*/
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            text-align: center;
        }
        .content {
           /* width: 80%;*/
          /*  padding: 20px;
            display: flex;*
            flex-wrap: wrap;*/
        }
        .product {
            /*width: 23%;*/
            margin: 1%;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
        }
        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .product h3 {
            margin: 10px 0;
            font-size: 1.1em;
        }
        .product p {
            margin: 5px 0;
        }
        
    </style>
</head>
<body>
    <div class="container row">
        <section class="top-slider wow fadeInUp col-md-12">
            <div class="top-banner" style="background-image: url(http://test2.restkarpaty.com.ua/images/potentional_clients1.jpg);/*width: 100%;height:100%;*/height:410px;background-position: center center;background-size: cover;display: block;">
                <div class="container  ">
                    <div class="row ">
                        <div class="col-md-12">
                            <div data-aos="fade-down" class="background-site slogan-border-radius slogan-description center aos-init aos-animate">Закажи сайт,</div>
                            <div data-aos="fade-left" class="slogan-description-small center aos-init aos-animate">который приводит клиентов</div>
                            <div data-aos="fade-right" class="background-site slogan-border-radius slogan-link center aos-init aos-animate">
                                <a class="zakazat-text" href="http://test2.restkarpaty.com.ua/kak_zakazat_sait">Как заказать сайт</a>
                                <!--<span id="zakazat111" class="zakazat-text" onClick="scrollInto()">Как заказать сайт</span><!--<a class="" href="">Заказать</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="sidebar11 col-md-3">
            <h2>Рубрики</h2>
            <ul>
            @foreach ($categories as $category)
                <li><a href="#">{{ $category->name }}</a></li>
            @endforeach
            </ul>
        </div>
        <div class="content col-md-9 row">1111
            @foreach ($items as $item)
                <div class="col-md-4">
                    <div class="card product">
                        <h3>{{ $item->id }}{{ $item->name }}</h3>
                            <img src="product1.jpg" alt="Товар 1">
                        
                        <p>----</p>
                    </div>
                </div>
            @endforeach
            
        </div>
        
    </div>
</body>
</html>

@stop