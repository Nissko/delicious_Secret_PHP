<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Товарный чек</title>
    <link rel="stylesheet" href="{{asset('style/account_check.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/bootstrap/bootstrap.min.css') }}"/>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <style>
        .flex-div{
            display: inline-block;
            float: right;
        }
        body {
            font-family: "dejavu sans", sans-serif !important;
            font-size: 13px;
            background: white;
            margin:0;
            padding: 0;
        }
        pre{
            font-family: "dejavu sans", sans-serif !important;
            font-size: 13px;
            margin-bottom: 0 !important;
        }
        .hr_style{
            width: 100%;
            height: 1px;
            background: black;
        }
    </style>
</head>
<body class="user-select-none">

<div class="two">
    <div class="table-order">
        <table class="iksweb">
            <tbody>
            <tr>
                <td class="text-center fs-6 tr_style"><img src="{{ asset('img/barcode.gif') }}" height="55"></td>
            </tr>
            <tr>
                <td class="text-left fs-6 tr_style"><pre>ООО "ВКУСНЫЙ СЕКРЕТ"</pre></td>
            </tr>
            <tr>
                <td class="text-left fs-6 tr_style"><pre>Магнитогорск, пр Карла Маркса, 162/2</pre></td>
            </tr>
            <tr>
                <td class="text-left fs-6 tr_style"><pre class="float-start">КПП 504143520</pre><pre class="float-end">ИНН 290982681603</pre></td>
            </tr>
            <tr>
                <td class="fs-6"><div class="hr_style"></div></td>
            </tr>
            <tr>
                <td class="text-center fs-5 tr_style"><pre>Заказ №{{ $orders -> id }}</pre></td>
            </tr>
            <tr>
                <td class="text-start tr_style fs-6"><pre>Программа: {{ $orders -> program -> name}}</pre></td>
            </tr>
            <tr>
                <td class="text-center tr_style fs-6"><pre class="float-start">Стоимость</pre><pre class="float-end">{{ $orders->price + 0 }}</pre></td>
            </tr>
            <tr>
                <td class="fs-6"><div class="hr_style"></div></td>
            </tr>
            <tr>
                <td class="text-center tr_style fs-6"><pre class="float-start">Всего:</pre><pre class="float-end">{{ $orders->price + 0 }}</pre></td>
            </tr>
            <tr>
                <td class="text-left fs-6 tr_style"><pre class="float-start">Дата: {{ $orders -> created_at -> format('d.m.Y') }}</pre><pre class="float-end">Статус: {{ $orders -> status }}</pre></td>
            </tr>
            <tr>
                <td class="text-center fs-6 tr_style"><a href="http://qrcoder.ru" target="_blank"><img src="http://qrcoder.ru/code/?https%3A%2F%2Fvk.com%2Fid575117838&4&0" width="132" height="132" border="0" title="QR код"></a></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
