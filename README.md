<!-- PROJECT SHIELDS -->

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]

<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="public/images/icon.png" alt="Logo" width="120" height="120">
  </a>

  <h3 align="center">Terribooks</h3>

  <p align="center">
    An awesome territory management system for JW Congregations!
    <br />
    <a href="https://github.com/Jordan-Davila/terribooks"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://terribooks.com">View Online Site</a>
    ·
    <a href="https://github.com/Jordan-Davila/terribooks/issues">Report Bug</a>
    ·
    <a href="https://github.com/Jordan-Davila/terribooks/issues">Request Feature</a>
  </p>
</p>

<!-- TABLE OF CONTENTS -->

## Table of Contents

-   [About the Project](#about-the-project)
    -   [Built With](#built-with)
-   [Getting Started](#getting-started)
    -   [Prerequisites](#prerequisites)
    -   [Installation](#installation)
-   [Usage](#usage)
-   [Roadmap](#roadmap)
-   [Contributing](#contributing)
-   [License](#license)
-   [Contact](#contact)
-   [Acknowledgements](#acknowledgements)

<!-- ABOUT THE PROJECT -->

## About The Project

[![Terribooks][product-screenshot]](https://terribooks.com)

There are many great territory management apps available online, however, none of them come packed with all the necesary tools needed to maintain and organize territories.

Why should you use terribooks:

-   Terribooks cuts down your time spent on managing your territories so you could focus on more important things.
-   It's new and up to date. Additionally, it's compatible with most tablets and phones.

Of course, no one system will serve all congregations since your needs may be different. So I'll be adding more features in the near future. You may also suggest new ideas or features by forking this repo and creating a pull request or opening an issue.

A list of commonly used resources that I find helpful are listed on the acknowledgements section.

### Built With

Main frameworks. Add-ons/plugins are at the acknowledgements section.

-   [Laravel 8 with JetStream](https://laravel.com)
-   [Inertia.js](https://inertiajs.com/)
-   [Vue](https://vuejs.org)

<!-- GETTING STARTED -->

## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

We recommend an Ubuntu Server but feel free to use whatever linux distro you prefer. The following software are required in order to install terribooks onto your server.

-   PHP >= 7.3
-   MySQL >= 5.4
-   Apache or NGINX
-   [Composer](https://getcomposer.org/)
-   [Node & NPM](https://www.npmjs.com/get-npm)
-   Google Chrome (This is needed to export PDF files)

### Installation

1. Clone the repo

```sh
git clone https://github.com/Jordan-Davila/terribooks.git
```

2. Install Composer Packages

```sh
composer install
```

3. Install NPM packages and build

```sh
npm install && npm run dev
```

4. Config your .env file. Here you can setup your database credentials.

```sh
cp .env-example .env
```

5. Generate Application Key for Laravel.

```sh
php artisan key:generate
```

6. Migrate

```sh
php artisan migrate
```

7. Directory Permissions (Optional)

"After installing Laravel, you may need to configure some permissions. Directories within the 'storage' and the 'bootstrap/cache' directories should be writable by your web server or Laravel will not run. If you are using the Homestead virtual machine, these permissions should already be set"

```sh
sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;
sudo chmod -R 777 ./storage
sudo chmod -R 777 ./bootstrap/cache/
```

<!-- USAGE EXAMPLES -->

## Usage

Please visit [Terribooks' Documentation Site](http://terribooks.com/docs/) for more info.

<!-- ROADMAP -->

## Roadmap

See the [open issues](https://github.com/Jordan-Davila/terribooks/issues) for a list of proposed features (and known issues).

<!-- CONTRIBUTING -->

## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.

<!-- CONTACT -->

## Contact

Jordan Davila - [@\_jordandavila](https://twitter.com/_jordandavila) - hi@jordandavila.com
Project Link: [https://github.com/Jordan-Davila/terribooks](https://github.com/Jordan-Davila/terribooks)

<!-- ACKNOWLEDGEMENTS -->

## Acknowledgements

-   [Leaflet.js](https://leafletjs.com/)
-   [Popper.js](https://popper.js.org/)
-   [Font Awesome](https://fontawesome.com)

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/Jordan-Davila/terribooks.svg?style=flat-square
[contributors-url]: https://github.com/Jordan-Davila/terribooks/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/Jordan-Davila/terribooks.svg?style=flat-square
[forks-url]: https://github.com/Jordan-Davila/terribooks/network/members
[stars-shield]: https://img.shields.io/github/stars/Jordan-Davila/terribooks.svg?style=flat-square
[stars-url]: https://github.com/Jordan-Davila/terribooks/stargazers
[issues-shield]: https://img.shields.io/github/issues/Jordan-Davila/terribooks.svg?style=flat-square
[issues-url]: https://github.com/Jordan-Davila/terribooks/issues
[license-shield]: https://img.shields.io/github/license/Jordan-Davila/terribooks.svg?style=flat-square
[license-url]: https://github.com/Jordan-Davila/terribooks/blob/master/LICENSE.txt
[product-screenshot]: public/images/home-mac-terribooks.png
