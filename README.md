## Popular Repositories

this is a simple php script get the popular repositories in github with pagination and filteration  ( date and programming language)

## local environmint 

this project build with docker ( php:7.4-apache ) image.

to run this project following next steps :

    * cd Devyanis/docker
    * docker-compose up -d
    * open the http://localhost:8181 to lunch the project

if you get Bad credentials message instead of data table just change 

    * GITHUB_TOKEN (get it from this link https://github.com/settings/tokens)
    * GITHUB_USER (your github user name)

in constants.php file with your git credentials

