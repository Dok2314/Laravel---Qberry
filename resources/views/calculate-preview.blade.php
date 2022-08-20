@extends('layouts.app')

@php /** @var \App\DTO\Order\CalculationOrderResultDTO $calculation */ @endphp

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Рассчетная стоимость') }}</div>

                    <div class="row">
                        <div class="card-group">
                            <div class="container">
                                Информация о бронировании:
                                <hr>
                                @if(!$calculation->not_enough_block)
                                    <div class="alert alert-warning">
                                        Недостаточно блоков для хранения
                                    </div>
                                @endif
                                Локация: {{ $location->name }}
                                <br>
                                Температура хранения: - {{ $calculation->recipe->temperature }} °C
                                <br>
                                Нужно морозильных камер: {{ $calculation->blocks_need }}
                                <br>
                                Морозильных камер доступно: {{ $calculation->available_block_count }}
                                <br>
                                Период хранения: с {{ $calculation->recipe->start_shelf_life->toDateString() }} по {{ $calculation->recipe->end_shelf_life->toDateString() }}
                                <br>
                                Стоимость: {{ $calculation->price }} $
                            </div>
                            <form action="{{ route('calculate.makeOrder', $location) }}" method="POST" class="form-control">
                                @csrf
                                <input type="hidden" name="location_id" value="{{ $location->id }}">
                                <input type="hidden" name="volume" value="{{ $calculation->recipe->volume }}">
                                <input type="hidden" name="temperature" value="{{ $calculation->recipe->temperature }}">
                                <input type="hidden" name="start_shelf_life" value="{{ $calculation->recipe->start_shelf_life }}">
                                <input type="hidden" name="end_shelf_life" value="{{ $calculation->recipe->end_shelf_life }}">

                                <button class="btn btn-success {{ $calculation->not_enough_block ? '' : 'disabled'}}">Забронировать?</button>
                            </form>
                            <a href="{{ url()->previous() }}"><button class="btn btn-warning">Изменить данные?</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
