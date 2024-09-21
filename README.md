# AI Alchemy

A shittier version of the thing that already exists

## How to install

<b>Create a database and enter the necessary credentials in the .env</b>

<b>Install the Yarn and Composer packages</b>

```sh
yarn install && composer install
```

<b>Structure and seed the database with Phinx</b>

```sh
phinx migrate && phinx seed:run
```

<b>Start the local development server(s)</b>

```sh
yarn dev
```

## How to play

Add any combination of items (up to four) to the right area and click merge.
