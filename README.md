# SimplePHPApp

 Simple PHP application containing basic classes abstraction. The application is based on Apache, MySQL, BrowserSync within Docker containers.


### Installation
Clone this repo, then change the current working directory to **app** folder and run composer update command.
 

### Docker

```sh
cd project/root/dir
docker-compose up -d
```
This will pull all necessary dependencies and create all the services from docker-compose.yml configuration.
### Usage


the application will be available on [ http://localhost:8080/index.php](http://localhost:8080/index.php)
or [ http://localhost:3000/index.php](http://localhost:3000/index.php) which is using BrowserSync for tracking changes in the files.

