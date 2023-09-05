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

 - report 
```sh
localhost:5000/report
```
 - drivers list
```sh
localhost:5000/report/drivers
```

