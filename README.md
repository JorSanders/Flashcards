# Useful Laravel commands
[Naming convention](https://github.com/alexeymezenin/laravel-best-practices#follow-laravel-naming-conventions)

Create templates

```docker-compose exec php php artisan make:migration create_foobars_table```

```docker-compose exec php php artisan make:model Foobar```

```docker-compose exec php php artisan make:controller FoobarController --resource --model=Foobar```

Migrate the changes to the db

```docker-compose exec php php artisan migrate```

## Startup

```docker-compose exec php composer install```

```docker-compose exec php php artisan key:generate```

# Run php applications with a Nginx host and a MySQL database

Docker running Nginx, PHP-FPM, MySQL 

INTENDED FOR DEVELOPMENT, insecurities excist for production enviroments

If you are using this repository and find any bugs, have any feature requests or feedback. Please message me I am always looking to improve. Pull Requests are always welcome too of course :D

## Overview

1. [Install prerequisites](#install-prerequisites)

    Before installing project make sure the following prerequisites have been met.

2. [Clone the project](#clone-the-project)

    Download the code from this repository.

3. [Run the application](#run-the-application)

    Start up the webservice.
    
4. [Easy customizations](#easy-customizations)

    Customize the project to your own needs
            
5. [Useful docker commands](#useful-docker-commands)

    Helpful list of docker commands I find usefull

6. [Docker setup](#docker-setup)

	Helpfull commands for your docker enviroment

## Install prerequisites

I created this project for Ubuntu(16.04). This is the only OS I tested on

* [Docker](https://docs.docker.com/engine/installation/)
* [Docker Compose](https://docs.docker.com/compose/install/)
* [Git](https://git-scm.com/downloads)

## Clone the project

Git clone, Or you can download a zipfile of this project.
```
$ git clone https://github.com/jorsanders/docker-php.git
```

Go to the project directory : 

```
$ cd <wherever you cloned the repo to>
Or you can open the location in your file explorer and right click -> open in explorer
```
## Run the application

2. Start the application :

```
$ docker-compose up -d
```
    
3. Open your browser :

[192.168.1.5](192.168.1.5)
   
   
## Easy customizations

You open up the .env file in the project root. You will see some enviorment variables just change these to your desired values.
These are the default values as how I set them up. Please change the IP address and projectname. If you cant open the .env file its hidden by default. Press ctrl H have it appear in explorer
```
IPV4ADDRESS=192.168.1
PROJECTNAME=docker
PHPVERSION=7.1
MYSQLVERSION=8.0
NGINXVERSION=1.13
``` 

Be sure to add the ip address in your host file.
Open it with.

```
sudo nano /etc/hosts
```
Then add a line like this. Change the first 3 parts of the ip address to how you set yours
```
192.168.100	.5	docker.dev www.docker.dev
```


## Useful Docker commands
For docker compose commands you'll first need to ```cd``` into the directory with your ```docker-compose.yml```. Or even better open up a terminal in phpstorm with ```alt + f12```

(Re)Starts all the containers defined in the project in the foreground. To detach (ctrl P + Q), to exit (ctrl + C)
```
docker-compose up
```

Same as above but runs it in the background (detached mode)
```
docker-compose up -d
```

Recreates all containers and forces all images to be rebuild
```
docker-compose up --force-recreate --build
```

Stops all containers listed in the compose.yml
```
docker-compose down
```

Lists all containers
```
docker ps -a
```

Lists all active containers
```
docker ps
```
Execute terminal commands in a container
```
docker-compose exec <service name> <shell command>
```

Inspect a container
```
docker inspect <container id>
```

Stops a container
```
docker stop <container id>
```

Stops all containers
```
docker stop $(docker ps -q)
```

Stops remove all stopped containers
```
docker container prune
```

Lists all docker images
```
docker images
```

Removes an image
```
docker image rm <image id>
```

Removes all images
```
docker image rm $(docker image ls -q)
```

List all networks
```
docker network ls
```

Remove a network
```
docker network rm <network id>
```

Remove all networks
```
docker network rm $(docker network ls -q)
```

### Docker setup

Because php doesnt have write permission in the Nginx container you can change the mode in the directory you want to upload files to from php. Probably don't want to do this on a production enviroment. Looking for a better way to handle this.
```
sudo chmod 0007 ./ -R
``` 

Optionally you can then gitignore chmod so you don't commit these changes in either your gitrepo or in your global gitignore. 
```
git config --global core.fileMode false
```

To run docker commands without sudo add yourself to the docker user group then reboot your machine.
```
sudo gpasswd -a $USER docker
```

To get access to the db, logs or server root files, which are owned by docker
```
sudo chown $USER ./<directory name> -R
```
