## Install

- buat nama database `db_kendaraanapi`
- ubah port mysql di .env default 3306 
- ubah config nama dan password mysql
- lakukan `php artisan migrate --seed` atau `php artisan migrate:fresh --seed`

## Testing dan routing

- Testing
  - untuk melakukan testing `./vendor/bin/phpunit` atau `phpunit`
  
- Routing
  - (POST) Login => `api/v1/auth/login` dengan email('test@test.com') dan password('password')
  - (POST) Profile/Me => `api/v1/auth/login`
  - (GET / Authorization) kendaraan => `api/v1/kendaraan`
  - (GET / Authorization) penjualan-kendaraan => `api/v1/penjualan-kendaraan`
  - (GET / Authorization) penjualan-perkendaraan => `api/v1/penjualan-perkendaraan`
  
# api-post
# api-post
