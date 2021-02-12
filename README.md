# Croftvel

### Setup Laravel

Clone the `.env.example` file and generate new keys for Laravel.

```
cp .env.example .env
php artisan key:generate
```

---

# Custom Artisan Commands

### Controllers

Controllers with basic endpoints included can be created with:

```
php artisan make:croft-controller MyThing
```

If the requests don't already exist the `requests` option can be passed to create them as well:

```
php artisan make:croft-controller MyThing --requests
```

### Requests

Requests with permissions already integrated can be created with the following commands:

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

### Policies

```
php artisan make:croft-policy MyThing
php artisan make:croft-policy MyThing --owned
``