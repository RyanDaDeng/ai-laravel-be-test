## Laravel Backend Test for a company

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

### API Structure

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

### API URI

The API routing name is following standard restful URI designs as best practice.

1. `POST /api/properties`   - create a new property
2. `POST /api/properties/{property_id}/analytics`  - create a new analytic to a property
3. `PUT /api/properties/{property_id}/analytics`  - update an analytic to a property
4. `GET /api/properties/{property_id}/analytics` - Get all analytics for an inputted property
5. `GET /api/summaries/property-analytics-report` - Get a summary of all property analytics for an inputted suburb/state/country


### Indexing

// database index design

### Testing

#### Feature Test

// todo mainly API test


#### Unit

// todo unit test
