# Progi Assessment Test

## Installation

1. clone the repository
2. Run `docker compose up --build -d`
3. Run `docker exec -it symfony_app composer install -o`
4. CD `frontend`
5. RUN `npm install`
6. RUN `npm run dev`
7. Load in browser: http://localhost:5173/
8. To run unit test: `docker exec -it symfony_app ./vendor/bin/phpunit --testdox`
