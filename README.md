# LunaShop

---
## Setup

Make sure vite is up and running in dev mode
```text
npm run dev
```

Initial setup must be executed in this order and is done via

```text
npm install  
php artisan lunar:install // Required, sets up the admin user and app
php artisan migrate
php artisan db:seed       // Optional, if you want some default data
php artisan serve
```
