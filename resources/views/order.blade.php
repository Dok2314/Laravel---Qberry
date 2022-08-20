@extends('layouts.app')

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
                                @if(!$notEnoughBlock)
                                    <div class="alert alert-warning">
                                        Недостаточно блоков для хранения
                                    </div>
                                @endif
                                Локация: {{ $location->name }}
                                <br>
                                Температура хранения: - {{ $neededTemperature }} °C
                                <br>
                                Нужно морозильных камер: {{ $blocksNeed }}
                                <br>
                                Морозильных камер доступно: {{ $availableBlockCount }}
                                <br>
                                Период хранения: с {{ $startShelfLife }} по {{ $endShelfLife }}
                                <br>
                                Стоимость: {{ $price }} $
                            </div>
                            <form action="{{ route('calculate.makeOrder') }}" method="POST" class="form-control">
                                @csrf
                                <input type="hidden" name="location_id" value="{{ $location->id }}">
                                <input type="hidden" name="temperature" value="{{ $neededTemperature }}">
                                <input type="hidden" name="start_shelf_life" value="{{ $startShelfLife }}">
                                <input type="hidden" name="end_shelf_life" value="{{ $endShelfLife }}">
                                <input type="hidden" name="price" value="{{ $price }}">
                                <input type="hidden" name="volume" value="{{ $volume }}">
                                <input type="hidden" name="available_blocks" value="{{ $availableBlockCount }}">
                                <input type="hidden" name="enough" value="{{ $notEnoughBlock }}">

                                <button class="btn btn-success {{ $notEnoughBlock ? '' : 'disabled'}}">Забронировать?</button>
                            </form>
                            <a href="{{ url()->previous() }}"><button class="btn btn-warning">Изменить данные?</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
