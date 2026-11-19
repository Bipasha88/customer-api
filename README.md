# Customer API

A **Laravel 8** REST API with a **Vue 2** single-page front end. It imports **1,000 customer records from a CSV file**, geocodes each customer's city with the **Google Maps Geocoding API**, and serves the results as JSON.

<!-- Add a screenshot of the customer list and the customer detail page -->
<!-- ![Customer list](docs/screenshots/customers.png) -->

## Features

- **CSV import command:** `php artisan store:customer-data` reads `public/file/customers.csv` and saves each row with `firstOrCreate`, so running it again doesn't create duplicates.
- **Geocoding:** each customer's city is sent to the Google Maps Geocoding API, and the returned **latitude and longitude** are stored with the customer.
- **REST API:** list all customers or fetch one by ID.
- **Vue SPA:** a customer list and a customer detail page, using Vue Router.
- **Unit tests:** the service layer is tested with mocked repositories.

## API

| Method | Endpoint             | Description           |
|--------|----------------------|-----------------------|
| GET    | `/api/customer`      | List all customers    |
| GET    | `/api/customer/{id}` | Get a single customer |

Example response:

```json
{
  "id": 1,
  "first_name": "Jane",
  "last_name": "Doe",
  "email": "jane@example.com",
  "gender": "Female",
  "company": "Acme",
  "city": "Berlin",
  "latitude": "52.52",
  "longitude": "13.40",
  "title": "Engineer"
}
```

## Architecture

```
app/
├── Console/Commands/importCsvCommand.php   # CSV import + geocoding
├── Http/Controllers/CustomersController.php
├── Services/Customer/                      # ICustomerService + implementation
├── Repositories/                           # Base + Customer repositories (interfaces + implementations)
└── Models/Customer.php
resources/js/components/                    # Vue: App, AllCustomers, SingleCustomer
tests/Unit/CustomerServiceTest.php
```

The controller depends on `ICustomerService`, and the service depends on `ICustomerRepository`. `AppServiceProvider` binds each interface to its implementation, so the service can be unit-tested with a mocked repository.

## Tech stack

PHP 7.3+/8 · Laravel 8 · MySQL · Vue 2 · Vue Router · Bootstrap 5 · Guzzle · Google Maps Geocoding API · PHPUnit

## Getting started

```bash
git clone https://github.com/Bipasha88/customer-api.git
cd customer-api

composer install
npm install

cp .env.example .env
php artisan key:generate
# In .env: set the DB_* values and GOOGLE_MAPS_KEY=<your key>

php artisan migrate
php artisan store:customer-data   # import + geocode the CSV (takes a few minutes)

npm run dev
php artisan serve
```

Open http://localhost:8000.

## Tests

```bash
php artisan test
```
