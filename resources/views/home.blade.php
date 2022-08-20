@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Список доступных локаций') }}</div>

                <div class="row">
                        <div class="card-group">
                            @foreach($locations as $location)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $location->name }}</h5>
                                    <hr>
                                    <p class="card-text">
                                        @php
                                            $availableBlocksCount = $location::availableBlocksCountByLocationId($location->id);
                                        @endphp
                                        @if($availableBlocksCount > 0)
                                            Морозильных камер доступно: ({{ $availableBlocksCount }})
                                        @else
                                            Нет доступных морозильных камер
                                        @endif
                                    </p>
                                    <hr>
                                    <a href="{{ route('calculate.view', $location) }}"><button class="btn btn-primary">Выбрать</button></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
