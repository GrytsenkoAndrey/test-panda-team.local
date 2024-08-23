# Test Task

## How to run locally

- clone project to the local directory
- into the directory run command in the terminal ```make up```
- wait until containers up
- run command into the terminal ```make app-bash```
- into the container run command ```composer install```, wait until the end of installation
- make copy of **.env.example** ```cp .env.example .env```
- set DB password **DB_PASSWORD**
- after that run command ```php artisan key:generate```
- and command ```php artisan migrate```
- and finally run command ```php artisan schedule:work```


## How to use

Using Postman send request to the **http://localhost:8230/api/v1/subscription**

with next parameters

<img src="public/img/postman.png">

and visiting **http://localhost:8025** you can see your email

<img src="public/img/subscribed.png">

