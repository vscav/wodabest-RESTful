[![Contributors][contributors-shield]][contributors-url]
[![MIT License][license-shield]][license-url]

<br />
<p align="center">
  <a href="https://github.com/N0Ls/Wodabest-REST">
    <img src="public/img/logo/wodabest.png" alt="Logo" width="80">
  </a>

  <h3 align="center">Wodabest</h3>

  <p align="center">
    A Tinder like Art Gallery !
    <br />
    <a href="">View online</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Built With](#built-with)
  * [Features](#features)
* [Getting Started](#getting-started)
* [Usage](#usage)
    * [Development](#development)
* [License](#license)
* [Contributors](#contributors)

<!-- ABOUT THE PROJECT -->
## About The Project

Wodabest is THE platform for sharing your artistic, creative and inventive works. More than just a gallery, Wodabest allows you to compare your most beautiful works through a system based on the ELO algorithm. Whether to inspire or challenge yourself, improve or prove your creative talent, don't waste any more time and join the Wodabest community.

Looking for inspiration? Curious? Take a tour of the art gallery to appreciate the wonderful work recently added. A preference ? Activate the filters!

Wondering how your works are doing in the midst of this fierce competition? Take a look at the leaderboard to see if your works have reached the heights!

Have you just finished your last creation? Don't wait any longer and bring it into the competition.

### Built With

Wodabest is built on a set of trendy technologies to provide you with an optimal user experience.
* [Bootstrap](https://getbootstrap.com)
* [Laravel](https://laravel.com)
* [Vue](https://vuejs.org/)

### Features

- REST API with Laravel 7 
- Vue + VueRouter + Vuex + VueI18n + ESlint
- Pages with dynamic import and custom layouts
- Authentication with JWT

## Getting Started

To setting up the project locally and get a local copy up and running, follow the following steps.

1. Clone the repository
```sh
git clone https://github.com/N0Ls/Wodabest-REST.git
```
2. Create a .env file to set your connection details
```sh
cp .env.example .env
```
3. Install Laravel to process the required files in web browser
```sh
composer install
```
4. Generate Laravel application key
```sh
php artisan key:generate
```
5. Generate a JWT secret key (will be used to sign your tokens)
```sh
php artisan jwt:secret
```
6. Run migrations with seed option
```sh
php artisan migrate --seed
```
7. Install NPM packages
```sh
npm install
```

## Usage

### Development


Open a terminal and run the following command :
```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

On another terminal, run :
```bash
php artisan serve
```

## License

Distributed under the MIT License.

## Contributors

Nils LANDRODIE - Backend Developper - nilsland31@gmail.com

Mattéo POPOFF - Backend Developper - pmatteo98@gmail.com

Cloé QUIRIN - Frontend Developer - cloequirin3@gmail.com

Léa ROSTOKER - Webdesigner - lea.rostoker.12@gmail.com

Vincent SCAVINNER - Frontend Developer - vscavinner@gmail.com

[contributors-shield]: https://img.shields.io/github/contributors/othneildrew/Best-README-Template.svg?style=flat-square
[contributors-url]: https://github.com/othneildrew/Best-README-Template/graphs/contributors
[license-shield]: https://img.shields.io/github/license/othneildrew/Best-README-Template.svg?style=flat-square
[license-url]: https://github.com/othneildrew/Best-README-Template/blob/master/LICENSE.txt