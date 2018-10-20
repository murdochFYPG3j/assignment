## ICT302 Project (Appointment Mate)


### API Documentation

Base URL: `http://api.fyp.darren.li`


#### Authentication

POST `/auth/register`
```
Request:
{
	"email": "test02@gmail.com",
	"password": "password",
	"role": "attendee",
	"first_name": "Darren",
	"last_name": "Li"
}
Response:
{
    "email": "test02@gmail.com",
    "first_name": "Darren",
    "last_name": "Li",
    "role": "attendee",
    "updated_at": "2018-10-20 16:31:32",
    "created_at": "2018-10-20 16:31:32",
    "id": 10
}
```

POST `/auth/login`
```
Request:
{
	"email": "test02@gmail.com",
	"password": "password"
}
Response:
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXV0aFwvbG9naW4iLCJpYXQiOjE1NDAwMjQ1MzksImV4cCI6MTU0MDA2NzczOSwibmJmIjoxNTQwMDI0NTM5LCJqdGkiOiJsMzRGdzI0YTlOVlF3Q041Iiwic3ViIjoxMCwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.wzK7AXa6k6868pZTPUv1DhGi7brFP3L6Qb91RumNLxg",
    "token_type": "bearer",
    "expires_in": 43200
}
```

POST `/auth/logout`
```
Response: 
{
    "message": "Successfully logged out"
}
```

#### Profile

GET `/auth/me`
```
Response:
{
    "id": 10,
    "email": "test02@gmail.com",
    "first_name": "Darren",
    "last_name": "Li",
    "role": "attendee",
    "created_at": "2018-10-20 16:31:32",
    "updated_at": "2018-10-20 16:31:32"
}
```

POST `/auth/me`
```
Request: 
{
	"first_name": "Derek"
}
Response:
{
    "id": 10,
    "email": "test02@gmail.com",
    "first_name": "Derek",
    "last_name": "Li",
    "role": "attendee",
    "created_at": "2018-10-20 16:31:32",
    "updated_at": "2018-10-20 16:39:39"
}
```


#### Users

GET `/users`
```
Response:
[
    {
        "id": 1,
        "email": "admin@gmail.com",
        "first_name": "Bennie",
        "last_name": "Rowe",
        "role": "convenor",
        "created_at": "2018-10-20 16:27:15",
        "updated_at": "2018-10-20 16:27:15"
    },
    ...
]
```

POST `/users`
```
Request:
{
    "email": "test003@gmail.com",
    "password": "password",
    "first_name": "Gowen",
    "last_name": "Smith",
    "role": "attendee"
}
Response:
{
    "email": "test003@gmail.com",
    "first_name": "Gowen",
    "last_name": "Smith",
    "role": "attendee",
    "updated_at": "2018-10-20 16:46:03",
    "created_at": "2018-10-20 16:46:03",
    "id": 11
}
```

UPDATE `/users/{id}`
```
Request:
{
    "first_name": "Chad"
}
Response:
{
    "id": 11,
    "email": "test003@gmail.com",
    "first_name": "Chad",
    "last_name": "Smith",
    "role": "attendee",
    "created_at": "2018-10-20 16:46:03",
    "updated_at": "2018-10-20 16:47:38"
}
```

DELETE `/users/{id}`
```
Response: 200 OK
```


#### Locations

GET `/locations`
```
Response:
[
    {
        "id": 1,
        "name": "Jaskolski Locks",
        "address": "47771 Burdette Light\nLake Erna, WI 05006-6933",
        "postal": "768936",
        "created_at": "2018-10-20 16:27:15",
        "updated_at": "2018-10-20 16:27:15"
    },
    ...
]
```

POST `/locations`
```
Request:
{
    "name": "JasGelski Locks",
    "address": "47792 Burdette Light 05006-6933",
    "postal": "768986"
}
Response:
{
    "name": "JasGelski Locks",
    "address": "47792 Burdette Light 05006-6933",
    "postal": "768986",
    "updated_at": "2018-10-20 16:49:20",
    "created_at": "2018-10-20 16:49:20",
    "id": 6
}
```

UPDATE `/locations/{id}`
```
Request:
{
    "name": "JasGelski Locks 2"
}
Response:
{
    "id": 6,
    "name": "JasGelski Locks 2",
    "address": "47792 Burdette Light 05006-6933",
    "postal": "768986",
    "created_at": "2018-10-20 16:49:20",
    "updated_at": "2018-10-20 16:49:44"
}
```

DELETE `/locations/{id}`
```
Response: 200 OK
```



#### Appointments

GET `/appointments`
```
Response:
[
    {
        "id": 1,
        "attendee_id": 8,
        "location_id": 5,
        "starts_at": "2018-02-21 04:33:01",
        "ends_at": "2018-02-21 05:03:01",
        "confirmed": 1,
        "created_at": "2018-10-20 16:27:15",
        "updated_at": "2018-10-20 16:27:15"
    },
    ...
]
```

POST `/appointments`
```
Request:
{
    "attendee_id": 7,
    "location_id": 3,
    "starts_at": "2018-10-21 14:30:00",
    "ends_at": "2018-10-21 15:00:00",
    "confirmed": 1
}
Response:
{
    "attendee_id": 7,
    "location_id": 3,
    "starts_at": "2018-10-21 14:30:00",
    "ends_at": "2018-10-21 15:00:00",
    "confirmed": 1,
    "updated_at": "2018-10-20 16:50:55",
    "created_at": "2018-10-20 16:50:55",
    "id": 11
}
```

UPDATE `/appointments/{id}`
```
Request:
{
    "starts_at": "2018-10-21 10:30:00",
    "ends_at": "2018-10-21 11:00:00"
}
Response:
{
    "id": 11,
    "attendee_id": 7,
    "location_id": 3,
    "starts_at": "2018-10-21 10:30:00",
    "ends_at": "2018-10-21 11:00:00",
    "confirmed": 1,
    "created_at": "2018-10-20 16:50:55",
    "updated_at": "2018-10-20 16:51:28"
}
```

DELETE `/appointments/{id}`
```
Response: 200 OK
```
