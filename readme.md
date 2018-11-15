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
    "role": "attendee"
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
    "role": "attendee"
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
        "role": "convenor"
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
    "role": "attendee"
}
```

DELETE `/users/{id}`
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
        "starts_at": "2018-02-21 04:33:01",
        "ends_at": "2018-02-21 05:03:01",
        "status": "Available",
        "attendee": {
            "id": 8
            "email": "test02@gmail.com",
            "first_name": "Darren",
            "last_name": "Li",
            "role": "attendee",
        },
        "meta": {
            "year": 2018,
            "month": 2,
            "day": 21,
            "start_time": "04:33",
            "end_time": "05:03"
        }
    },
    ...
]
```

POST `/appointments`
```
Request:
{
    "attendee_id": 7,
    "starts_at": "2018-10-21 14:30:00",
    "ends_at": "2018-10-21 15:00:00",
    "status": "Available"
}
Response:
{
    "attendee_id": 7,
    "starts_at": "2018-10-21 14:30:00",
    "ends_at": "2018-10-21 15:00:00",
    "status": "Available",
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
    "starts_at": "2018-10-21 10:30:00",
    "ends_at": "2018-10-21 11:00:00",
    "status": "Available"
}
```

DELETE `/appointments/{id}`
```
Response: 200 OK
```

#### Additionals

GET `appointment-slots/all?year=2018&month=10`
GET `appointment-slots/available?year=2018&month=10`
```
Response:
{
    "year": 2018,
    "month": 8,
    "days": [
        {
            "day": 26,
            "slots": [
                {
                    "id": 16,
                    "attendee_id": null,
                    "starts_at": "2018-08-26 16:01:24",
                    "ends_at": "2018-08-26 16:31:24",
                    "status": "Available",
                    "attendee": {
                        "id": 8
                        "email": "test02@gmail.com",
                        "first_name": "Darren",
                        "last_name": "Li",
                        "role": "attendee",
                    },
                    "meta": {
                        "year": 2018,
                        "month": 2,
                        "day": 21,
                        "start_time": "04:33",
                        "end_time": "05:03"
                    }
                }
            ]    
        },
        {
            "day": 29,
            "slots": [
                {
                    "id": 8,
                    "attendee_id": 1,
                    "starts_at": "2018-08-29 12:36:34",
                    "ends_at": "2018-08-29 13:06:34",
                    "status": "Available",
                    "attendee": {
                        "id": 8
                        "email": "test02@gmail.com",
                        "first_name": "Darren",
                        "last_name": "Li",
                        "role": "attendee",
                    },
                    "meta": {
                        "year": 2018,
                        "month": 2,
                        "day": 21,
                        "start_time": "04:33",
                        "end_time": "05:03"
                    }
                }
            ]
        }
    ]
}
```

POST `/auth/reset-password`
```
Request:
{
    "email": "admin@gmail.com"
}
Response: 200 OK
```

POST `/appointment-slot/{apmt_id}/book`
POST `/appointment-slot/{apmt_id}/cancel`
```
Request: NIL
Response: 200 OK
```

GET `/my-appointments`
```
Response:
[
    {
        "id": 1,
        "attendee_id": 8,
        "starts_at": "2018-02-21 04:33:01",
        "ends_at": "2018-02-21 05:03:01",
        "status": "Available"
    },
    ...
]
```

GET `/stats`
```
Response:
{
    "Appointment": {
        "Pending": 2
    }
}
```

GET `/files/template.csv`
```
Respoinse: Download
```

POST `/import-appointments`
```
Request:
file: UploadFile

Response: 200 OK
```

POST `/create-or-update-appointments`
```
Request:
[{ "id": 1, "status": "Available" }, { "id": 2, "status": "Available" }]
Response: 200 OK
```

POST `/create-or-update-appointments`
```
Request:
[
    { "starts_at": "2018-07-03 01:00:00", "ends_at": "2018-07-03 02:00:00" }, 
    { "starts_at": "2018-07-05 01:00:00", "ends_at": "2018-07-05 02:00:00" }
]
Response: 200 OK
```