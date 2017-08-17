REM-server API
===========================================

###Get the dataset {#all}

Get the full dataset, or a part of it.

```text
GET /remserver/api/[dataset]
GET /remserver/api/users
```

Results.

```json
{
    "data": [],
    "offset": 0,
    "limit": 25,
    "total": 0
}

{
    "data": [
        {
            "id": "1",
            "firstName": "Phuong",
            "lastName": "Allison"
        },
        ...
    ],
    "offset": 0,
    "limit": 25,
    "total": 12
}
```

Optional query string parameters.

* `offset` defaults to 0.
* `limit` defaults to 25.

```text
GET /remserver/api/users?offset=0&limit=25
```



###Get one entry {#one}

Get one entry based on its id.

```text
GET /remserver/api/users/7
```

Results.

```json
{
    "id": "7",
    "firstName": "Etha",
    "lastName": "Nolley"
}
```



###Create a new entry {#create}

Add a new entry to a dataset, create the dataset if it does not exists and will add a id to the entry.

```text
POST /remserver/api/[dataset]
{"some": "thing"}

POST /remserver/api/users
{"firstName": "Mikael", "lastName": "Roos"}
```

Results.

```json
{
    "some": "thing",
    "id": 1
}

{
    "firstName": "Mikael",
    "lastName": "Roos",
    "id": 13
}
```



###Upsert/replace a entry {#upsert}

Upsert (insert/update) or replace a entry, create the dataset if it does not exists.

```text
PUT /remserver/api/[dataset]/1
{"id": 1, "other": "thing"}

PUT /remserver/api/users/13
{"id": 13, "firstName": "MegaMic", "lastName": "Roos"}
```

The value in the id-field is updated to match the one from the PUT request value.

Results.

```json
{
    "other": "thing",
    "id": 1
}

{
    "id": 13,
    "firstName": "MegaMic",
    "lastName": "Roos"
}
```



###Delete a entry {#delete}

Delete a entry.

```text
DELETE /remserver/api/[dataset]/1

DELETE /remserver/api/users/13
```

The result will always be `null`.



Other REM servers {#other}
-------------------------------------------

There are more servers doing the same thing.

* [REM REST API](http://rem-rest-api.herokuapp.com/)
