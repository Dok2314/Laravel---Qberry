### Laravel - Qberry

## Старт

1) Регистрируемся в приложении;

2) Выполняем следующие команды:
`php artisan migrate;`
`php artisan db:seed;`

3) Конечная точка API: http://domain.com/api/order

Пример тестового запроса:

`http://127.0.0.1:8000/api/order?user_id=1&location_id=4&volume=40&needed_temperature=12&start_shelf_life=2022-08-20&end_shelf_life=2022-08-24&blocks_count=25&token=aikfFpA9%23far&status=1&price=400`

Тестовые данные:

`
'volume'            => 40,
'temperature'       => 12,
'start_shelf_life'  => 2022-08-20,
'end_shelf_life'    => 2022-08-24
`
