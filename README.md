# Task 6 (Setup guide)

1. Select a directory
```sh
cd <path directory_for_repository>
```
2. Clone repo and select a branch
```sh
git clone -b task_6 https://git.foxminded.ua/foxstudent105191/php-6.git
```
3. Build Docker image and run Docker container
```sh
docker-compose up -d --build
```
4. Write data from files to database
```sh
 - docker-compose exec -it app bash
```
```sh
 - php artisan migrate
```
```sh
 - php artisan add:data
```
```sh
 - exit
```
5. Run application in browser
 - report(with sort from fastests)
```sh
localhost:5000/report
```
- report(with sort from slowest)
```sh
localhost:5000/report/?order=desc
```
 - drivers list(with sort from fastests)
```sh
localhost:5000/report/drivers
```
 - API report (JSON file)
 ```sh
http://localhost:5000/api/v1/report/?format=json
 ```
 - API report (XML file)
 ```sh
 http://localhost:5000/api/v1/report/?format=xml
 ```
 - API drivers list (JSON file)
 ```sh
 http://localhost:5000/api/v1/report/drivers/?format=json
 ```
 - API drivers list (XML file)
 ```sh
 http://localhost:5000/api/v1/report/drivers/?format=xml
 ```
 - API driver's info (JSON file)
 ```sh
 http://localhost:5000/api/v1/report/drivers/LHM/?format=json
 ```
 - API driver's info (XML file)
 ```sh
 http://localhost:5000/api/v1/report/drivers/LHM/?format=xml
 ```
6. Run Swagger documents
```sh
 - docker-compose exec -it app php artisan l5-swagger:generate
```
```sh
 - http://localhost:5000/api/documentation
```
7. Run tests
```sh
docker-compose exec -it app php artisan test
```
8. Run tests with coverage
```sh
docker-compose exec -it app php artisan test --coverage-html coverage
```
9. Delete data from database
```sh
docker-compose exec -it app php artisan delete:data
```

