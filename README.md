### Laravel - Qberry

## Старт

1) В приложении уже есть тестовый пользователь со следующими данными:
`login: demo`
`password: demo`;

2) Выполняем следующие команды:
`php artisan migrate;`
`php artisan db:seed;`

3) Конечная точка API: http://domain.com/api/order

Пример тестового запроса:

`http://127.0.0.1:8000/api/order`

Тестовые данные:

`
'volume'            => 40,
'temperature'       => 12,
'start_shelf_life'  => 2022-08-20,
'end_shelf_life'    => 2022-08-24
`
