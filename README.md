# HMVC_Generator
A Laravel package to create and manage your large laravel app using modules [HMVC]


### Folder Structure
- Modules
	- Users
		- Config/
		- Database/
			- Migrations/
		- Http/
			- Controllers/
				- TestController.php
			- Middleware/
				- TestMiddleware.php
			- Requests/
				- TestRequest.php
		- Models/
			- Test.php
		- Providers/
			- UsersServiceProvider.php
		- Resources/
			- Lang/
				- ar/
				- en/
			- Views/
				- test.blade.php
		- Routes/
			- web.php  "All Routes under "users" prefix"
			- api.php  "All Routes under "api/users" prefix"
	
### Artisan Commands
- To create a new module you can simply run :
```
php artisan make:module <module_name>
```
- Create new Controller for the specified module :
```
php artisan module:controller <controller_name> --module_name=<module_name>
```
- Create new Model for the specified module :
```
php artisan module:model <model_name> --module_name=<module_name>
```
- Create new Middleware for the specified module :
```
php artisan module:middleware <middleware_name> --module_name=<module_name>
```
- Create new Request for the specified module :
```
php artisan module:request <request_name> --module_name=<module_name>
```
- Create new Migration for the specified module :
```
php artisan module:migration <migration_name> --module_name=<module_name> --table=<table_name>
```

### Routes
> **api.php** => These routes are loaded by the <module_name>ServiceProvider within a group which is assigned the "api" middleware group and "api/<module_name>" prefix

> **web.php** => These routes are loaded by the <module_name>ServiceProvider within a group which contains the "web" middleware group and "<module_name>" prefix.

### Views
> Calling View: view('<module_name>::view_file_name')
