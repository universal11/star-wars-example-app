# Star Wars Example App
<br>
  
## Retrieving Starships By Pilot Name
<br>

### Via CLI
```
php artisan star-wars:get-starships-by-pilot-name "Luke Skywalker"
```

### Via API
```
GET /api/Starship/getByPilotName/Luke%20Skywalker
```
<br>
<br>

## Retrieve classification of all species by episode
<br>

### Via CLI
```
php artisan star-wars:get-species-classifications-by-episode 1
```

### Via API
```
GET /api/Film/getSpeciesClassificationsByEpisode/1
```

## Retrieve total population of all the planets in the galaxy
<br>

### Via CLI
```
php artisan star-wars:get-galaxy-total-population
```

### Via API
```
GET /api/Galaxy/getTotalPopulation
```