# Documentation du backend Laravel du portfolio

## 1) Objectif de cette architecture

Ce projet transforme le portfolio statique en application Laravel avec:
- un backend MySQL;
- phpMyAdmin pour l'administration visuelle;
- des vues Blade pour les pages frontend;
- une table `users` avec un compte administrateur;
- une table `projects` pour tes projets;
- une table `contacts` pour les messages du formulaire.

## 2) Structure des dossiers ajoutes

- `.docker/`: configuration d'infrastructure Docker.
  - `.docker/php/Dockerfile`: image PHP-FPM avec extensions Laravel (`pdo_mysql`, `zip`, `gd`).
  - `.docker/nginx/default.conf`: serveur Nginx qui expose `backend/public`.
- `docker-compose.yml`: orchestre 4 services (`app`, `nginx`, `mysql`, `phpmyadmin`).
- `backend/`: application Laravel.
  - `app/Models`: modeles Eloquent (`Project`, `Contact`).
  - `app/Http/Controllers`: logique HTTP (`PortfolioController`, `ContactController`).
  - `database/migrations`: creation des tables SQL.
  - `database/seeders`: alimentation initiale des donnees.
  - `resources/views`: templates Blade.
  - `public/assets`: assets statiques repris depuis ton ancien frontend.

## 3) Explication fichier par fichier

### `docker-compose.yml`

- `app`: lance PHP-FPM, monte `./backend` pour executer Laravel.
- `nginx`: publie l'app sur `http://localhost:8000`.
- `mysql`: base de donnees `portfolio` (port local `3307`).
- `phpmyadmin`: interface DB sur `http://localhost:8081`.
- `volumes.mysql_data`: persistance des donnees MySQL.

Importance: sans ce fichier, pas d'environnement unifie ni reproductible.

### `.docker/php/Dockerfile`

- `FROM php:8.3-fpm`: base officielle PHP.
- `apt-get install`: outils systeme + libs pour ZIP et images.
- `docker-php-ext-install pdo_mysql zip gd`: extensions indispensables Laravel.
- `COPY --from=composer:2`: ajoute Composer dans le conteneur.

Importance: garantit que Laravel tourne avec les extensions attendues.

### `.docker/nginx/default.conf`

- `root /var/www/public`: force Nginx a servir uniquement le dossier public (securite).
- `try_files ... /index.php`: active le routing Laravel.
- `location ~ \.php$`: envoie le PHP vers le service `app`.
- `deny all` sur fichiers caches.

Importance: protege le code source et fait fonctionner les routes propres.

### `backend/.env` et `backend/.env.example`

- `APP_NAME=Portfolio`, `APP_URL=http://localhost:8000`.
- localisation en francais (`APP_LOCALE`, `APP_FALLBACK_LOCALE`).
- passage de SQLite vers MySQL (`DB_CONNECTION=mysql`, host `mysql`, credentials `portfolio`).

Importance: connecte Laravel au service MySQL Docker.

### `backend/app/Models/Project.php`

- attribut `Fillable` limite les champs autorises en assignation massive.
- `casts()` convertit automatiquement `skills` et `details` (JSON <-> array PHP).

Importance: securite des ecritures + manipulation propre des tableaux.

### `backend/app/Models/Contact.php`

- `Fillable` pour les champs du formulaire.

Importance: permet l'enregistrement des messages avec protection mass-assignment.

### `backend/app/Http/Controllers/PortfolioController.php`

- `presentation()`: rend la page presentation.
- `sphere()`: lit les projets DB, normalise le format et l'envoie a Blade.
- `contact()`: rend la page contact.

Importance: separation claire entre vues et donnees.

### `backend/app/Http/Controllers/ContactController.php`

- `store(Request $request)`:
  - valide les donnees (`required`, email valide, tailles max);
  - enregistre en base dans `contacts`;
  - redirige avec message de succes en session.

Importance: validation serveur (indispensable securite) + persistance des contacts.

### `backend/database/migrations/2026_04_23_130000_create_projects_table.php`

- cree `projects` avec titre, categorie, couleur, image, description, skills/details JSON, lien.

Importance: schema officiel de tes projets en base.

### `backend/database/migrations/2026_04_23_130100_create_contacts_table.php`

- cree `contacts` avec nom, email, sujet, message.

Importance: stocke durablement les demandes recues via le formulaire.

### `backend/database/seeders/DatabaseSeeder.php`

- cree/maj un admin:
  - email `admin@portfolio.local`
  - mot de passe `Admin1234!` (hash via `Hash::make`).
- appelle `ProjectSeeder`.

Importance: demarrage rapide avec un compte admin et donnees minimales.

### `backend/database/seeders/ProjectSeeder.php`

- injecte des projets initiaux (`updateOrCreate` evite les doublons).

Importance: la sphere 3D affiche directement des projets sans saisie manuelle initiale.

### `backend/routes/web.php`

- `GET /` -> page presentation.
- `GET /portfolio` -> sphere avec projets DB.
- `GET /contact` -> formulaire.
- `POST /contact` -> enregistrement du contact.

Importance: routes centralisees et explicites.

### `backend/resources/views/presentation.blade.php`

- conversion de `index.html` vers Blade:
  - liens CSS/JS/images via `asset(...)`;
  - navigation vers `route('portfolio')`.

Importance: le frontend passe sous moteur Blade.

### `backend/resources/views/sphere-portfolio.blade.php`

- conversion HTML -> Blade (`asset`, `route`).
- injection des donnees backend:
  - `window.__PROJECTS__ = @json($projects);`

Importance: alimente le JS front depuis la base MySQL.

### `backend/resources/views/contact.blade.php`

- conversion HTML -> Blade.
- formulaire:
  - `@csrf` (protection CSRF);
  - affichage erreurs validation;
  - conservation des anciennes valeurs (`old(...)`);
  - affichage message succes session.

Importance: securite formulaire + meilleure UX.

### `backend/public/assets/javascript/script.js`

- remplacement des donnees hardcodees par:
  - `const projects = (window.__PROJECTS__ || []).map(...)`

Importance: la sphere lit maintenant les projets venant du backend.

## 4) Commandes d'installation et execution

Depuis la racine `portfolio`:

1. Construire et lancer les services:
   - `docker compose up -d --build`
2. Installer dependances Laravel (si necessaire):
   - `docker compose exec app composer install`
3. Migrer + seeder:
   - `docker compose exec app php artisan migrate:fresh --seed`

Acces:
- Site Laravel: `http://localhost:8000`
- phpMyAdmin: `http://localhost:8081`
  - serveur: `mysql`
  - user: `portfolio`
  - mot de passe: `portfolio`

## 5) Notes securite importantes

- Validation serveur active sur formulaire contact.
- Protection CSRF active (`@csrf`).
- Mass assignment limitee avec `Fillable`.
- Mot de passe admin hashé (jamais en clair en base).
- Nginx expose uniquement `public/`.

## 6) Ameliorations recommandees ensuite

- Ajouter un vrai back-office admin (authentification + CRUD projets).
- Uploader les images en stockage Laravel au lieu de chemins statiques.
- Ajouter rate limiting anti-spam sur `POST /contact`.
- Ajouter tests `Feature` pour contact et affichage projets.

## 7) Petite page admin ajoutee

- URL: `http://localhost:8000/admin/projects`
- Protection: middleware `auth.basic` (popup navigateur).
- Identifiants admin seedes:
  - email: `admin@portfolio.local`
  - mot de passe: `Admin1234!`
- Fonctionnalites:
  - ajout d'un projet;
  - upload d'image;
  - stockage image dans `storage/app/public/projects`;
  - affichage rapide des projets existants.

Commande utile apres migration/seed:
- `docker compose exec app php artisan storage:link`
