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

Requests and policies can be created along with the controller:

```
php artisan make:croft-controller MyThing --requests
php artisan make:croft-controller MyThing --policies
php artisan make:croft-controller MyThing --requests --policies
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

Preconfigured policies can be created with:

```
php artisan make:croft-policy MyThing
```

If the resource has ownership properties the `owned` option can be used:

```
php artisan make:croft-policy MyThing --owned
```
