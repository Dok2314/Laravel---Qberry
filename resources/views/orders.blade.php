@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Список активных заказов:') }}</div>

                    <div class="row">
                        <div class="card-group">
                            <div class="container">
                                @foreach($orders as $order)
                                    @php
                                        $today      = \Carbon\Carbon::now();
                                        $start_day  = Carbon\Carbon::parse($order->created_at);
                                        $expiry_day = $start_day->addDays(24);
                                    @endphp
                                    <div class="card w-100 container">
                                        <div class="card-body">
                                            <h5 class="card-title">Локация: {{ $order->findLocationById($order->location_id)->name }}</h5>
                                            К оплате: {{ $order->price }} $
                                            <br>
                                            Обьем товара: {{ $order->volume }} м/3
                                            <br>
                                            Нужная температура: -{{ $order->needed_temperature }} °C
                                            <br>
                                            Срок хранения: с {{ $order->start_shelf_life }} по {{ $order->end_shelf_life }}
                                            <br>
                                            Нужно морозильных камер: {{ $order->blocks_count }} шт.
                                            <br>
                                            Уникальный токен заказа: <string class="text-success">{{ $order->token }}</string>
                                            <br>
                                            @if($expiry_day !== $today)
                                                Статус: <string class="{{ $order->status ? 'text-success' : 'text-danger'}}">{{ $order->status ? 'Активен' : 'Не активен' }}</string>
                                            @else
                                                Статус: <string class="text-danger">Не активен</string>
                                            @endif
                                            <br>
                                            Заказ создан: {{ $order->created_at }}
                                            <br>
                                            Активен до: {{ $expiry_day }}
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            </div>
                            <div class="mb-5">
                                {{ $orders->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
