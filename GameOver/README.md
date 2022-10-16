
## GameOver Assignment

### Database and Migration

- Run the command 

```js
php artisan mysql:creatdb-gameover
```
to create the database and connect. (file under console->commands)

- Run the migration 

```js
php artisan migrate
```
to create the table (quotes) as it will be used to store price lists.

### Notes and Hints

- Route is under api/quotes in routes/api.php file
- You can check this commit 
https://github.com/StavAlev1/GameOver/commit/d58755e28a6484c7fbb9cce9e5b179234c788188
to see #1 of the tasks, as it was reworked later by #2 requests
- Controller uses external service to do the given requests
- No Validation is used for request data
- Json file is custom made
- Run below command to get all price lists created in the database table in terminal
```js
php artisan get:quotes
```
