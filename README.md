## Install

- buat nama database `db_testapi`
- ubah port mysql di .env default 3306
- ubah config nama dan password mysql
- lakukan `php artisan migrate --seed` dan `php artisan migrate:refresh --seed` atau `php artisan migrate:fresh --seed`

## Testing dan routing

- Testing berguna untuk semua fungsi berjalan dengan baik jika terjadi error check user role ada atau tidak user visitor dan writer
  - untuk melakukan testing `./vendor/bin/phpunit` atau `phpunit`

- Routing
  - Auth
    - (POST) Login => `api/v1/auth/login`
      - email => `writer@test.com` dan password => `password`
      - email => `visitor@test.com` dan password => `password`
    - (POST) Register => `api/v1/auth/register`
      - parameters => name, email, password, role (visitor / writer)

  - Post
    - (GET / Authorization as writer or visitor) Daftar Post => `api/v1/post/`

    - (GET / Authorization as writer or visitor) Detail Post => `api/v1/post/1`

    - (POST / Authorization as writer) Tambah Post => `api/v1/post/1`
      - parameters => title, description,

    - (PUT / Authorization as writer) Update Post => `api/v1/post/1`
      - parameters => title, description,

    - (DELETE / Authorization as writer) Delete Post => `api/v1/post/1`
