# Croftvel API

This project provides a starter codebase for creating a headless CRUD API.

# Authentication

The `App\Models\Identity` model contains the records used to identify a person
via email address, mobile number, or OAuth provider.

The `App\Models\Secret` model contans the confidential records used to verify
the identity of a person such as a password or OAuth token.

These are used together with the `App\Models\User` model to perform all
authentication via the `App\Guards\Api\v1\ApiGuard` guard.

# Authorization

Authorization/Permissions is controlled by the `App\Models\Privilege` and
`App\Models\Ability` models. All actions performed by users after authentication
will be checked against these models.

The `App\Models\Privilege` model is a name given to a collection of abilities.

The `App\Models\Ability` model defines an action by name as well as the model
that the action will be affecting. The affected model is defined using its fully
qualified class name (e.g. `App\Models\Profile\UserGallery`) or a wildcard
(i.e. `*`). Along with the model a specific id can be given to resrict the
action to a single resource, or a `NULL` value can be given for the id which
will allow the ability on all resources.

A `hasMany` relationship exists between `App\Models\Privilege` and `App\Models\Ability`.

A pivot table associates `App\Models\Ability` and `App\Models\User`.

# Custom Artisan Commands

### — Controllers

Controllers can be generated with the `make:croft-controller` command:

```
php artisan make:croft-controller ModelName
```

The option `--requests` can be used to geneate the request classes and implement
them into the generated controller:

```
php artisan make:croft-controller ModelName --requests
```

### — Policies

Policies can be generated with the `make:croft-policy` command:

```
php artisan make:croft-policy ModelName
```

### — Requests

Requests with permissions already integrated can be created with the following
commands:

```
php artisan make:croft-request ModelName --ability=index
php artisan make:croft-request ModelName --ability=show
php artisan make:croft-request ModelName --ability=store
php artisan make:croft-request ModelName --ability=update
php artisan make:croft-request ModelName --ability=destroy
```

Multiple requests can be created at once with the `make:croft-requests` command:

```
php artisan make:croft-requests ModelName --abilities=index,store,update
```

If the `--abilities` option is not given then all requests for index, show,
store, update, and destroy will be created:

```
php artisan make:croft-requests ModelName
```
