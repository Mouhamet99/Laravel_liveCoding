<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and
creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in
many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache)
  storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all
modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video
tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging
into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in
becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in
the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by
the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell
via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Generer notre base de donnees

### Installation vai Composer

```Terminal```

```shell
composer create-project laravel/laravel example-app
```

### Configuer Initial base de donnee

```.env```

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_first_step
DB_USERNAME=root
DB_PASSWORD=
```

### Generer notre model Pays avec migration et controller

```Terminal```

```shell
php artisan make:model Pays -mc
```

## Ajouter des champs à notre migration pour Pays

```database/migrations/2022_03_11_112912_create_regions_table.php```

```php
public function up()
{
    $table->id();
    $table->string("name")->unique();
    $table->timestamps();
}
```

## Generate migration

```Terminal```

```shell
php artisan migrate
```

## Generer notre model Regions avec migration et controller

```Terminal```

```shell
php artisan make:model Regions -mc
```

## Ajouter des champs à notre migration

```database/migrations/.....create_regions_table.php```

```php
public function up()
{
    $table->id();
    $table->string("name")->unique();
    $table->timestamps();
}
```

***
***
<p style="color: greenyellow">NB: Pour Annuler les  migrations</p>
Cela les derniers migrations qui ont ete faites 

```shell
php artisan migrate:rollack
```

##Generons les migrations
```shell
php artisan migrate
```


### Ajoutons une cle etrangere (Foreign Key) pays_id à Pays

```database/migrations/.....create_regions_table.php```

```php
public function up()
{
  //....
$table->foreignId('pays_id')->constrained('pays')
                ->onUpdate('cascade')
                ->onDelete('cascade');
}
```

### mettons à jour notre base de donnee
```Terminal```
```shell
php artisan migrate:fresh
```
***
***
# Remplir Notre Base avec des jeux de fausses donnees

### Generons un factory pour nos Pays
```Terminal```
```shell
php artisan make:factory PaysFactory   
```

### Configuerons les champs

````PaysFactory.php````

```php

 public function definition()
    {
        return [
            'nom'=> $this->faker->company(),
            'indicatif' => $this->faker->areaCode
        ];
    }
```

### Generons un seeder pour nos Pays

````Terminal````

```shell
php artisan make:seeder PaysSeeder
```

### Configuer notre seeder pour qu'il nous genere 3 pays

````PaysSeeder.php````

```php
 public function run()
    {
        Pays::factory()->count(3)->create();
    }
```

### Lançons l'execution

```shell
php artisan db:seed --class=PaysSeeder
```

### Generons un factory pour notre table Region

```Terminal```

```shell
php artisan make:factory RegionFactory   
```

### Configurons les champs

```RegionFactory```

```php

  public function definition()
    {
        return [
            "nom"=> $this->faker->unique()->country(),
            "pays_id"=> $this->faker->numberBetween(1, 10)
        ];
    }
```
### Generons un seeder pour notre table Region
````Terminal````

```shell
php artisan make:seeder RegionSeeder
```

### Configuer notre seeder pour qu'il nous genere 30 regions et configuer le à ce qu'il soit dans un pays exisants dans notre base de donnee

````RegionSeeder.php````

```php
  public function run()
    {
        return Region::factory()
            ->count(30)
            ->state(new Sequence(
                fn($sequence) => ['pays_id' => Pays::all()->random()],
            ))
            ->create();
    }
```

### Lançons l'execution

```Terminal```

```shell
php artisan db:seed --class=RegionSeeder
```

# Definissons nos routes

### 1) Definissons notre premiere route

```routes/web.php```

```php
Route::get('/pays', [PaysController:: class, 'index']);
```

### 2-a) definissons la methode index qui doit etre appelé à ce qu'il retourne *Hello World*

```PaysController.php```

```php
 public function index()
    {
        return 'Hello World';
    }
```

### 2-b)  Faisons çe qu'il retourne les informations suivantes dans un vue

- id du pays
- indicatif du pays
- nombre de regions

#### Requete qu'on aurais du ecrire sans laravel

```sql 
select count(r.id) as nombre , pays_id as id, p.nom as pays from regions as r join pays p on p.id = r.pays_id group by pays_id;
```

```PaysController.php```

```php
 public function index()
    {
        $paysRegions = DB::table('regions')
            ->select(DB::raw('pays_id as id,  pays.nom as pays, indicatif , count(regions.id) as nombre_regions'))
            ->groupBy('pays_id', 'pays.nom', 'pays.indicatif')
            ->join('pays', 'pays.id', '=', 'pays_id')
            ->get();

        return view('pays.index', [
            'paysRegions' => $paysRegions
        ]);
    }
```

### 2-c)Configurons notre vue à qu'il recupere le tableau renvoyé par notre vue et l'affiche sur une balise table

```ressouces/views/pays/index.blade.php```

```html

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Indicatif</th>
        <th scope="col">Nom</th>
        <th scope="col">Nbre regions</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($paysRegions as $pays)
    <tr>
        <th scope="row">{{$loop->index}}</th>
        <td>{{$pays->indicatif}}</td>
        <td>{{$pays->pays}}</td>
        <td>{{$pays->nombre_regions}}</td>
        <td>
            <button type="button" class="btn btn-sm btn-primary">Regions</button>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
```
