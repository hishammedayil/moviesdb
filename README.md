# moviesdb
A movies DB with websockets implementation to live update the comments on a movie

### Installation / Run
#### Using docker-compose (recommended)
```shell
docker-compose up -d --build
docker exec -it movies-web-dist bash
php artisan migrate
php artisan db:seed
```
- Navigate to localhost:28000 to access the application
#### Without docker
This will require adjusting
- Websocket server ports
- DB connection settings

in the `.env` file inside the webroot directory.
```shell
cd webroot
cp .env.example .env
composer install
npm install
npm run dev
php artisan migrate
php artisan db:seed
php artisan serve
# In a different terminal / window
php artisan websockets:serve
```
- Navigate to the port that laravel dev server is listening to on a browser 
