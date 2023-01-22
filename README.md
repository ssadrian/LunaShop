# LunaShop

## Control Panel
The control panel is found on [/hub](http://localhost/hub)

## Setup

- Make sure vite is up and running in dev mode
```text
npm run dev
```

Initial setup must be executed in this order and is done via

- Install packages; One Time
```text
npm install
```

- Setup admin account
```text
php artisan lunar:install
```

- Add some mock products to the pages; Optional
```text
php artisan db:seed
```

- Serve on port 80, if any other port is specified then the images won't be shown correctly
```text
php artisan serve --port 80
```
