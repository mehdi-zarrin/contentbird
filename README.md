Please clone the project: 

`git@github.com:mehdi-zarrin/interview-demo-contentbird.io.git`

Note: I assumed you have node and npm installed on your computer.

once clone process complete run the following if you have docker installed on your machine:

`docker-compose build && docker-compose up -d && docker exec contentbird_php composer install && docker exec contentbird_php php /var/www/html/artisan migrate && npm i && npm run watch`

then in your browser:
 
http://127.0.0.1:8080

There are two branches in this project:

**1- master**

**2- vuex-version**

if you run the project by npm run watch you can switch to the vuex-version branch and the changes will be compiled automatically otherwise you have to compile it on your own:

`npm run dev`

There are some test included in the project to run them in the project root please do the following:

`vendor/bin/phpunit`




if you don’t have docker please do the following:

1- update the .env file with your database credentials and host information

2- run composer install in the project root

3- run npm install && npm run watch

4- run php artisan serve
 
5- browse the project from the given port

-----
**I hope you find this project interesting.** 

**Thanks for reading.**

**Mehdi**
