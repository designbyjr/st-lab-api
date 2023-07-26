
# Store-Lab

I have designed, developed, and containerized a RESTful API for a simple e-commerce application using Laravel and Docker.

I have created a docker conatiner using laravel sail. 

The IP address for the project is:

`0.0.0.0`

You will need to have composer and php 8.1 or greater installed and docker.
Make sure docker is running before running commands below in order.

DO:
```bash
Composer Install

php artisan sail:install

alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

sail up

sail php artisan migrate -seed

```


## API Reference

#### Login

```http
  POST /api/login
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. Your email address |
| `password` | `string` | **Required**. Your password |


Returns user and Bearer token.

#### Register

```http
  POST /api/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Your name |
| `email` | `string` | **Required**. Your email address |
| `password` | `string` | **Required**. Your password |
| `password_confirmation` | `string` | **Required**. Your confirmation of your password |

Returns user and Bearer token.

#### Logout

```http
  POST /api/logout
```

`Only Bearer token is required.`


#### Get product by ID

```http
  GET /api/products/${id}
```
`Bearer token is required.`

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

Returns one product by ID.

#### Get all products

```http
  GET /api/products/
```
`Bearer token is required.`

Returns all products

#### Create a product.

```http
  POST /api/products/
```
`Bearer token is required.`

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**. Name of product |
| `color`      | `string` | **Required**.  color of product |
| `price`      | `numeric` | **Required**.  price of product|
| `category`      | `string` | **Required**.  category of product|


Returns newly created product, limited to one product at a time


#### Update a product by ID.

```http
  PUT /api/products/${id}
```
`Bearer token is required.`

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**. Name of product |
| `color`      | `string` | **Required**.  color of product |
| `price`      | `numeric` | **Required**.  price of product|
| `category`      | `string` | **Required**.  category of product|


Returns newly updated product, limited to one product at a time


#### Delete a product by ID.

```http
  DELETE /api/products/${id}
```
`Bearer token is required.`

Returns blank array on success.


## Running Tests

To run tests, run the following command

```bash
  sail php artisan test
```

