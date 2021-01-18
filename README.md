## Laravel Backend Test for a company

[![Coverage Status][ico-coverage]][link-coverage]
[![Build][ico-build]][link-build]


## Code Overview

The following directory are main places that I modified:

- app/Helpers
- app/Http/Controllers/Api/V1
- app/Http/Requests
- app/Models
- app/Modules
- database/seeders
- database/factories
- app/Imports
- tests/Feature
- tests/Unit
- routes

## Dependencies

- Laravel 8.x
- PHP > 7.3

## Installation

#### .env config

1. Config your database as `mysql` driver in your `.env` file.

#### Data Migration

1. Run Data Migrate command

```bash
php artisan migrate
```

2. Run data seeding

```bash
php artisan db:seed
```

The `.xlxs` located at `storage/dummy`.

The project is using 3rd party excel library to import data - `maatwebsite/excel`.

All import classes located at `app/Imports`.

Run command to migrate


## Design Details

### API Core Helpers

The API structure contains the following three simple main helper functions:

````
- app
  -- Helpers
     -- ApiController
     -- ApiFormRequest
     -- ApiStructureTrait
````

`ApiController` is used to provide functions that generate response into a structured response.

`ApiFormRequest` is used for form request to support JSON response, by default it returns web request.

`ApiStructureTrait` a collection of functions that formatting response.


### API URI Design

The API routing name is following standard restful URI designs as best practice.

1. `POST /api/v1/properties`   - create a new property
2. `POST /api/v1/properties/{property_id}/analytics`  - create a new analytic to a property
3. `PUT /api/v1/properties/{property_id}/analytics/{analytic_id}`  - update an analytic to a property
4. `GET /api/v1/properties/{property_id}/analytics` - Get all analytics for an inputted property
5. `GET /api/v1/property-analytics-reports/suburb-report` - Get a summary of all property analytics for an inputted suburb
6. `GET /api/v1/property-analytics-reports/state-report` - Get a summary of all property analytics for an inputted state
7. `GET /api/v1/property-analytics-reports/country-report` - Get a summary of all property analytics for an inputted country


Note: API 5,6,7 can be merged as one.

### Validation Layer

In my solution, I employed the Laravel its own FormRequest class that enables me to do validation out of box.

````
- app
  -- Http
     -- Requests
         -- AddNewAnalyticToPropertyApiRequest
         -- CreatePropertyApiRequest
         -- PropertyAnalyticSummaryApiRequest
         -- UpdateAnalyticToPropertyApiRequest
````

In Controller layer, the following code will handle all errors out of box.

````php

$request->validated();

````

### Service Layer

All main business logic saved in service folder. Since the requirement is fairly easy, we can just move all logic to conrtoller layer that could minimise the codebase.

However, in real life, the logic could be complicated as it may require 3rd party integration or different module communications, I decoupled them for future improvements. Additionally, its also good for unit level testing.

````
- app
  -- Modules
     -- PropertyMamnagement
         -- Services
            -- PropertyAnalyticService
            -- PropertyAnalyticSummaryService
     -- Report
            -- AbstractSummaryReport
            -- CountrySummaryReport
            -- StateSummaryReport
            -- SuburbSummaryReport
````


For report query, there are many easier ways to do it.
- using Join query
- pure query inside each controller function
etc..

The reason that I over-engineered it because I want to demonstrate my OO skills.


### Testing


#### Factories

````
- database
  -- factories
     -- AnalyticTypeFactory
     -- PropertyAnalyticFactory
     -- PropertyFactory
````

#### Feature Test

Please check all tests under `tests/Feature`

### CI/CD

#### Travis CI



#### CD
Not needed as no server required for this test.


[ico-coverage]: https://coveralls.io/repos/github/RyanDaDeng/ai-laravel-be-test/badge.svg?branch=main&service=github
[ico-build]: https://travis-ci.org/RyanDaDeng/ai-laravel-be-test.svg?branch=main
[link-coverage]: https://coveralls.io/github/RyanDaDeng/ai-laravel-be-test?branch=main
[link-build]: https://travis-ci.org/RyanDaDeng/ai-laravel-be-test
