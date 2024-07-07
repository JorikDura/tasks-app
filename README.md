# Task-app **Laravel**
Приложение - трекер задач. Исключительно бэкенд. PHP 8.3

## Структура проекта
Модели:
1. Task;
2. Comment;
3. User;

Используемые зависимости:
1. Laravel sail;
2. Laravel pint;
3. Laravel sanctum;
4. Larastan;
5. Pest;

## Примеры запросов и ответы
### Get all tasks
```
api/v1/tasks
```
Возвращает список превью задач с пагинацией (максимум 20) <br>
Возможные `params`:
* status — число, enum (Status);
  * BrainStorming = 1;
  * Planned = 2;
  * InWork = 3;
  * Done = 4;
  * Canceled = 5;
* deadline[] — массив (1 элемент). Принимает оператор и дату (d-m-Y).
  * eq — равно
  * mt — больше чем
  * lt — меньше чем
  * mti — больше чем включительно
  * lti — меньше чем включительно

Ответ:

```json
{
    "id": 1,
    "creatorId": 1,
    "performerId": 2,
    "title": "praesentium",
    "status": "canceled",
    "complexity": "easy",
    "urgency": 1,
    "deadlineAt": "2024-07-07T00:00:00.000000Z"
}
```

### Get task by id

```
localhost/api/v1/tasks/{id}
```

Где id — Task id

Ответ:

```json
{
        "id": 1,
        "creator": {
            "id": 1,
            "name": "Логинова Доминика Львовна"
        },
        "performer": {
            "id": 2,
            "name": "Ершов Глеб Борисович"
        },
        "title": "praesentium",
        "description": "Quisquam fugit ut voluptates fuga aut facilis. Laudantium nostrum ullam laudantium sit sint cumque blanditiis. Dolor repellendus et voluptatum rem error ducimus.",
        "status": "canceled",
        "complexity": "easy",
        "urgency": 1,
        "comments": [
            {
                "id": 1,
                "user": {
                    "id": 21,
                    "name": "Клавдия Романовна Князева"
                },
                "text": "Ut et ipsam blanditiis et est necessitatibus veniam. Perspiciatis harum nam inventore ex. Omnis natus molestias quia. Quas et qui qui soluta.",
                "createdAt": "2024-07-07T00:00:00.000000Z"
            }
        ],
        "createdAt": "2024-07-07T00:00:00.000000Z",
        "updatedAt": "2024-07-07T00:00:00.000000Z",
        "deadlineAt": "2024-07-07T00:00:00.000000Z"
}
```
