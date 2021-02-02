# Croftvel

### Setup Laravel

Clone the `.env.example` file and generate new keys for Laravel.

```
cp .env.example .env
php artisan key:generate
```

### Setup JWT Authentication

The `Tymon/JWTAuth` library requires a `JWT_SECRET` param in the .env file. Either manually add it or use the command below.

```
php artisan jwt:secret
```

---

### Custom Artisan Commands

RESTful requests with `Bouncer` permissions already integrated can be created with the following commands:

```
php artisan make:croft-request MyThing --ability=index
php artisan make:croft-request MyThing --ability=show
php artisan make:croft-request MyThing --ability=store
php artisan make:croft-request MyThing --ability=update
php artisan make:croft-request MyThing --ability=destroy
```

Multiple requests can be created at once with the `make:croft-requests` command:

```
php artisan make:croft-requests MyThing --ability=index,store,update
```

RESTful controllers with basic endpoints, and the above RESTful requests, automatically included can be created with the following commands:

```
php artisan make:croft-controller MyThing --type=admin
php artisan make:croft-controller MyThing --type=user
```

The `type` option denotes which namespace (e.g. `App\Controllers\Api\v1\Admin`) will be used.

If the RESTful requests don't already exist then the `requests` option can be passed to create them as well:

```
php artisan make:croft-controller MyThing --type=admin --requests
```
