# Symfony - Doctrine relations

## Installation

Clone this repository.
```
git clone https://github.com/TBoileau/symfony-doctrine-relations.git
```

Install dependencies
```
composer install
```

Create and edit a new env file `.env.local`
```
# .env.local
DATABASE_URL=mysql://root:password@127.0.0.1:3306/symfony-doctrine-relations
```

Create the database 
```
bin/console doctrine:database:create
```

Update the schema 
```
bin/console doctrine:schema:update -f
```

Load the fixtures 
```
bin/console hautelook:fixtures:load -n
```

Start the server
```
bin/console server:run
```

Note : *If you use Windows, don't forget to add `php` in front of each command with `bin/console`.*