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
4. Run application in browser

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
 - drivers list(with sort from slowest)
```sh
localhost:5000/report/drivers/?order=desc
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
5. Run Swagger documents
```sh
 - docker-compose exec -it app php artisan l5-swagger:generate
```
```sh
 - http://localhost:5000/api/documentation
```
6. Run tests
```sh
docker-compose exec -it app php artisan test
```
7. Run tests with coverage
```sh
docker-compose exec -it app php artisan test --coverage-html coverage
```

