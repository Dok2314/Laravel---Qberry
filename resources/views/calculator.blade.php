@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Подсчет стоимости') }}</div>

                    <div class="row">
                        <div class="card-group">
                            <form action="{{ route('calculate.calculateOrder', $location) }}" method="POST" class="form-control">
                                @csrf
                                <div class="form-group mb-3">
                                    <b>Выбраная локация:</b>
                                    <h5>"{{ $location->name }}"</h5>
                                </div>
                                <div class="form-group mb-3">
                                    <h5>Обьем продуктов (в м3)</h5>
                                    <input type="number" name="volume" value="{{ old('volume') }}">
                                </div>
                                @error('volume')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group mb-3">
                                    <h5>Необходимая температура хранения</h5>
                                    <input type="number" name="temperature" pattern="^\d*(\.\d{0,2})?$" value="{{ old('temperature') }}">
                                </div>
                                @error('temperature')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group mb-3">
                                    <h5>Срок хранения (можно хранить не более 24 дней)</h5>
                                    С <input type="date" name="start_shelf_life" value="{{ old('start_shelf_life') }}">
                                    по <input type="date" name="end_shelf_life" value="{{ old('end_shelf_life') }}">
                                </div>
                                @error('start_shelf_life')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                @error('end_shelf_life')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                                <button type="submit" class="btn btn-success">Рассчитать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('keydown', 'input[pattern]', function(e){
            var input = $(this);
            var oldVal = input.val();
            var regex = new RegExp(input.attr('pattern'), 'g');

            setTimeout(function(){
                var newVal = input.val();
                if(!regex.test(newVal)){
                    input.val(oldVal);
                }
            }, 1);
        });
    </script>
@endpush
