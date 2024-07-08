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

Каждый запрос должен принимать `Header`, для получения данных в формате json:

```
Accept — application/json
```

Запрос может содежрать `Header` — `Accept-Language` для получения значений в разных языках.

По-умолчанию значение `ru`.

### Register
```
POST api/v1/auth/register
```

Регистрирует пользователя.

Принимает:
* name — имя, мин. 6, макс, 48, уникальное, обязательно
* email — почта, уникальное, обязательно
* password — пароль, базовые правила для пароля, обязательно
* password_confirmation — подтверждение пароля, обязательно

Возвращает:
```json
{
    "token": "---token",
    "refreshToken": "---refresh-token"
}
```

### Login

```
POST api/v1/auth/login
```

Авторизация.

Принимает:
* email — почта, обязательно
* password — пароль, обязательно

Возвращает:
```json
{
    "token": "---token",
    "refreshToken": "---refresh-token"
}
```

### Refresh token

```
POST api/v1/auth/refresh-token
```

Возвращает новый токен.

Принимает:
* Refresh Token

Возвращает:
```json
{
    "token": "---token",
    "refreshToken": "---refresh-token"
}
```

### Get all tasks
```
GET api/v1/tasks
```
Возвращает список превью задач с пагинацией (максимум 20)

Только для авторизованных пользователей.

Принимает:
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
GET api/v1/tasks/{id}
```

Где id — Task id

Возвращает полную задачу, включая создателя, исполнителя, комментарии.

Только для авторизованных пользователей.

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

### Add task

```
POST api/v1/tasks
```

Создает новую задачу.

Только для авторизованных пользователей.

Принимает:
* title — заголовок, обязательно
* description — описание, необязательно
* status — чиисло, enum (Status), обязательно
    * BrainStorming = 1;
    * Planned = 2;
    * InWork = 3;
    * Done = 4;
    * Canceled = 5;
* complexity — сложность задачи, enum(Complexity), обязательно.
    * Easy = 1;
    * Medium = 2;
    * Hard = 3;
    * UltraHard = 4;
* urgency — срочность задачи, от 1 до 10, обязательно.
* deadlineAt — дата, формат d-m-Y, необязательно
* performerId — число, id пользователя-исполнителя, необязательно

Возвращает полную задачу (указана выше).

### Edit task

```
PATCH api/v1/tasks/{id}
```

Где id — Task id

Редактирует существующую задачу.

Только для авторизованных пользователей.

Принимает:
* title — заголовок, необязательно
* description — описание, необязательно
* status — чиисло, enum (Status), необязательно
    * BrainStorming = 1;
    * Planned = 2;
    * InWork = 3;
    * Done = 4;
    * Canceled = 5;
* complexity — сложность задачи, enum(Complexity), необязательно
    * Easy = 1;
    * Medium = 2;
    * Hard = 3;
    * UltraHard = 4;
* urgency — срочность задачи, от 1 до 10, необязательно
* deadlineAt — дата, формат d-m-Y, необязательно
* performerId — число, id пользователя-исполнителя, необязательно

Возвращает полную задачу (указана выше).

### Delete task

```
DELETE api/v1/tasks/{id}
```

Где id — Task id

Удаляет существующую задачу.

Только для авторизованных пользователей.

Возвращает статус (success, error).

### Add comment

```
POST api/v1/tasks/{id}/comment
```

Где id — Task id

Добавляет комментарий задаче.

Только для авторизованных пользователей.

Принимает:
* text — текст, макс. 255, обязательно.

Возвращает комментарий:
```json
{
    "id": 1,
    "user": {
            "id": 1,
            "name": "User1"
        },
    "text": "Deus Ex Machina",
    "createdAt": "2024-07-08T00:00:00.000000Z"
}
```

### Delete comment

```
DELETE api/v1/tasks/{taskId}/comment/{commentId}
```

Где taskId — Task id

Где commentId — Comment id

Удаляет комментарий.

Только для авторизованных пользователей.

Возвращает статус (success, error).
