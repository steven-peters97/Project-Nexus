# Description 
Project-Nexus is the website project for the EvenLegion Star Citizen Organization.

# Installation Instructions
- Ensure that you have PHP 8.4 installed
- Ensure you have Node.js installed
- Then clone the repo into your local development environment
- Open a terminal window in the app directory
- Pick the development env file and rename it to .env
- If you need client secret, id for the auth let me know(Razor).
- There is a php.ini this should be used. You will need to get a cacert.pem for the Oauth
- Install Composer from https://getcomposer.org
- Run ```composer install```
- Run ```npm install```
- Run ```php artisan key:generate```
- Run ```php artisan migrate```
- Run ```composer run dev```
