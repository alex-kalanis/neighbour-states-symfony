# neighbour-states-symfony

This is a testing project for running data about neighbour states with land border crossings.
For these purposes it discards things like EuroTunnel or that there is no crossing between
Panama and Colombia and more such things.

## Symfony inside

This docker contains following parts:

- The application itself
- Postgres database
- [Adminer](http://localhost:40509/) for database lookup
<!-- - [Swagger](http://localhost:40500/api/documentation) for endpoint hints -->

The whole project is built on Symfony framework

## Getting started

To get this docker just run:

```bash
git clone https://github.com/alex-kalanis/neighbour-states-symfony.git neighbour-states-symfony       # get the docker setting
cd neighbour-states-symfony                                       # into project
./install.sh                                                      # do the all necessary steps
```

### Tests

are under Console and can be run from CLI.

```bash
docker exec -it testing-neighbour-states-symfony-php8 /application/composer.phar test
```

*Beware!* They use the same tables as main application; so running tests truncate all data!
After running tests it became necessary to reintroduce the main data!

PHPStan is also available:

```bash
docker exec -it testing-neighbour-states-symfony-php8 /application/composer.phar analyse
```

And at last CS fixer:

```bash
docker exec -it testing-neighbour-states-symfony-php8 /application/composer.phar cs-fixer
```
