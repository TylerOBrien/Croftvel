# Croftvel API

# Authorization

Authorization/Permissions is controlled by the `App\Models\Privilege` and `App\Models\Ability` models. All actions performed by users after authentication will be checked against these models.

The `App\Models\Privilege` model is a name given to a collection of abilities.

The `App\Models\Ability` model defines an action by name as well as the model that the action will be affecting. The affected model is defined using its fully qualified class name (e.g. `App\Models\Profile\UserGallery`) or a wildcard (i.e. `*`). Along with the model a specific id can be given to resrict the action to a single resource, or a wildcard can be given.

A `hasMany` relationship exists between `App\Models\Privilege` and `App\Models\Ability`.

A pivot table associates `App\Models\Ability` and `App\Models\User`.

# Custom Artisan Commands

### Policies

Policies can be generated with the `make:croft-policy` command:

```
php artisan make:croft-policy Feed/Post
```

### Requests

Requests with permissions already integrated can be created with the following commands:

```
php artisan make:croft-request Feed/Post --ability=index
php artisan make:croft-request Feed/Post --ability=show
php artisan make:croft-request Feed/Post --ability=store
php artisan make:croft-request Feed/Post --ability=update
php artisan make:croft-request Feed/Post --ability=destroy
```

Multiple requests can be created at once with the `make:croft-requests` command:

```
php artisan make:croft-requests Feed/Post --abilities=index,store,update
```

If the `--abilities` option is not given then all requests for index, show, store, update, and destroy will be created:

```
php artisan make:croft-requests Feed/Post
```
