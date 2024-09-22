# AI Alchemy

A shittier version of the thing that already exists

## How to install

<b>- Create the database:</b><br>
&emsp;Charset:`utf8mb4`<br>
&emsp;Collation: `utf8mb4_unicode_ci`

<b>- Enter the credentials in the .env</b><br>
<b>- Correct the default database name(s) for all environments in phinx.php</b>

<b>- Install the Yarn and Composer packages:</b>

```sh
yarn install && composer install
```

<b>- Structure and seed the database with Phinx:</b>

```sh
phinx migrate && phinx seed:run
```

<b>- Start the local development server(s):</b>

```sh
yarn dev
```
