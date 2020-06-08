# Outliers Website
This repository contains the website of outliers.org.za, no sensitive information should be commited to the repository. All senstive information and passwords contained in the docker images are just for development purposes and does not represent the live site.

## Developer Setup
### Requirements
- [Docker](https://www.docker.com/community-edition)

### Starting and stopping docker containers
- `docker-compose up -d` to start docker containers.
- `docker-compose down` to stop and remove containers.
If you need to recreate the containers and have it run a new db import you can run `docker-compose up -d --force-recreate`.

### Login & Accounts
Once the docker containers are started the site can be access locally using http://localhost:8000 the login is as follow:
- Username: outliers
- Passowrd: outliers
