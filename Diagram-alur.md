Diagram Alur Request Laravel KursusKu

Pengguna membuka browser
          |
          v
Request GET /
          |
          v
routes/web.php
          |
          v
Route bernama home
          |
          v
HomeController@index
          |
          v
Menyiapkan $siteName
dan data $featured
          |
          v
Mengirim data ke
view('home')
          |
          v
resources/views/home.blade.php
          |
          v
Blade merender HTML
dan menampilkan kartu kursus
          |
          v
HTML dikirim ke browser
          |
          v
Halaman KursusKu tampil

Penjelasan

1. Pengguna membuka halaman utama melalui browser.
2. Laravel menerima request "GET /".
3. "routes/web.php" mengarahkan request ke "HomeController@index".
4. Controller menyiapkan nama situs dan data kursus.
5. Controller mengirim data ke view "home".
6. Blade merender data menjadi HTML.
7. Browser menampilkan halaman KursusKu.