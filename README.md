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

# Generons notre base de donnees

### Installation via Composer

```Terminal```

```shell
composer create-project laravel/laravel example-app
```

### Configurons notre environnement base de donnee

```.env```

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_first_step
DB_USERNAME=root
DB_PASSWORD=
```

### Generons notre model Pays avec migration et controller

```Terminal```

```shell
php artisan make:model Pays -mc
```

### Ajoutons des champs à notre migration pour Pays

```database/migrations/2022_03_11_112912_create_regions_table.php```

```php
public function up()
{
    $table->id();
    $table->string("name")->unique();
    $table->timestamps();
}
```

### Generons nos migrations

```Terminal```

```shell
php artisan migrate
```

### Generer notre model Regions avec migration et controller

```Terminal```

```shell
php artisan make:model Regions -mc
```

### Ajoutons des champs à notre migration

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
Cela supprime les derniers migrations qui ont ete faites 

```shell
php artisan migrate:rollack
```

### Generons les migrations

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

### Configurons les champs

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

### Configurons notre seeder pour qu'il nous genere 3 pays

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

### Configurons notre seeder pour qu'il nous genere 30 regions et configuer le à ce qu'il soit dans un pays exisants dans notre base de donnee

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

### 2-a) Definissons la methode index qui doit etre appelé à ce qu'il retourne *Hello World*

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

### 2-d) Ajoutons une nouvelle route pour lister les regions d'un pays connaissant son id

```web.php```

```php
Route::get('/pays/{id}', [PaysController:: class, 'getRegions'])->whereNumber('id');
```

### 2-e) Configurons notre fonction qui doit etre appelée

```PaysController.php```

```php
    public function getRegions($id)
    {
        $pays= Pays::find($id);
        $regions = Region::all()->where('pays_id', "=", $id);

        return view('pays.regions', [
            'regions' => $regions,
            'pays' => $pays
        ]);
    }
```

### 2-e) Configurons notre vue à ce qu'il recupere le tableau envoyé par la fonction et les affiche dans une balise table

```ressouces/views/pays/regions.blade.php```

```html

<div class="container my-5 pt-5">
    <div class="container">
        <h1><span class="fw-bold">Pays: </span> {{$pays->nom}}</h1>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($regions as $region)
        <tr>
            <th scope="row">{{$loop->index}}</th>
            <td>{{$region->nom}}</td>
            <td>
                <button type="button" class="btn btn-sm btn-primary"><i
                    class="fa-solid fa-arrow-up-right-from-square"></i></button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
```

### Generons notre model Departement, Commune, Quartier et Quartier,Entreprise avec migration et controller

```Terminal```

```shell
 php artisan make:model Departement -mc
 php artisan make:model Commune -mc
 php artisan make:model Quartier -mc
 php artisan make:model Entreprise -mc
```

***
***
***

### Generons un factory pour notre table Departement

```Terminal```

```shell
php artisan make:factory DepartementFactory   
```

### Configurons les champs

```DepartementFactory```

```php

  public function definition()
    {
        return [
            "nom"=> $this->faker->unique()->country(),
            "pays_id"=> $this->faker->number()
        ];
    }
```

### Generons un seeder pour notre table Departement

````Terminal````

```shell
php artisan make:seeder DepartementSeeder
```

### Configurons notre seeder pour qu'il nous genere 60 regions et configuer le à ce qu'il soit dans un pays exisants dans notre base de donnee

````DepartementSeeder.php````

```php
  public function run()
    {
     return Departement::factory()
            ->count(60)
            ->state(new Sequence(
                fn($sequence) => ['region_id' => Region::all()->random()],
            ))
            ->create();
    }
```

### Lançons l'execution

```Terminal```

```shell
php artisan db:seed --class=DepartementSeeder
```



