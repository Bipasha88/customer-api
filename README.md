##Installation


####Install Dependancies
1. Install dependencies
   ```bash
       # 1. update and/or install php packages based on your system
       composer update
       # or just try to install
       composer install
       
       # 2. install node packages
       npm install
   ```
2. Create & Update `.env` file
    1. ``` copy .env.example .env ```
    2. Update application name
    3. Generate app key `php artisan key:generate`
    3. Create database for this application
    4. Add you ```GOOGLE_MAPS_KEY=``` in `.env` file

3. Create Tables
   ```bash
   php artisan migrate
   ```
   
4. Store the customers information in database
    ```bash
    php artisan store:customer-data
    ```
####Run Unit Test
```bash
php artisan test
```

###Run The Application
```bash
npm run dev

php artisan serve
```
