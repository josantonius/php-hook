# PHP Hook library

[![Latest Stable Version](https://poser.pugx.org/josantonius/hook/v/stable)](https://packagist.org/packages/josantonius/hook) [![Total Downloads](https://poser.pugx.org/josantonius/hook/downloads)](https://packagist.org/packages/josantonius/hook) [![Latest Unstable Version](https://poser.pugx.org/josantonius/hook/v/unstable)](https://packagist.org/packages/josantonius/hook) [![License](https://poser.pugx.org/josantonius/hook/license)](https://packagist.org/packages/josantonius/hook)

[English version](README.md)

Librería para manejo de hooks.

---

- [Instalación](#instalación)
- [Requisitos](#requisitos)
- [Cómo empezar y ejemplos](#cómo-empezar-y-ejemplos)
- [Métodos disponibles](#métodos-disponibles)
- [Uso](#uso)
- [Tests](#tests)
- [Manejador de excepciones](#manejador-de-excepciones)
- [Contribuir](#contribuir)
- [Repositorio](#repositorio)
- [Licencia](#licencia)
- [Copyright](#copyright)

---

### Instalación 

La mejor forma de instalar esta extensión es a través de [composer](http://getcomposer.org/download/).

Para instalar PHP Hook library, simplemente escribe:

    $ composer require Josantonius/Hook

El comando anterior solamente instalará los archivos necesarios, si prefieres descargar todo el código, incluyendo tests, puedes utilizar:

    $ composer require Josantonius/Hook --prefer-source

También puedes clonar el repositorio completo con Git:

	$ git clone https://github.com/Josantonius/PHP-Hook.git

### Requisitos

Esta ĺibrería es soportada por versiones de PHP 5.6 o superiores y es compatible con versiones de HHVM 3.0 o superiores.

Para utilizar esta librería en HHVM (HipHop Virtual Machine) tendrás que activar los tipos escalares. Añade la siguiente ĺínea "hhvm.php7.scalar_types = true" en tu "/etc/hhvm/php.ini".

### Cómo empezar y ejemplos

Para utilizar esta librería, simplemente:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;
```
### Métodos disponibles

Métodos disponibles en esta librería:

```php
Hook::getInstance();
Hook::setSingletonName();
Hook::setHook();
Hook::addHook();
Hook::run();
Hook->collectHook();
```
### Uso

Ejemplo de uso para esta librería:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;

$Hook = Hook::getInstance();

$hooks = [
    'css'        => 'Namespace\Class\Example@css',
    'js'         => 'Namespace\Class\Example@js',
    'after-body' => 'Namespace\Class\Example@afterBody',
    'footer'     => 'Namespace\Class\Example@footer',
];

$Hook->addHook($hooks);

$Hook->run('meta');
$Hook->run('css');
$Hook->run('js');
$Hook->run('after-body');
$Hook->run('footer');
```

### Tests 

Para utilizar la clase de [pruebas](tests), simplemente:

```php
<?php
$loader = require __DIR__ . '/vendor/autoload.php';

$loader->addPsr4('Josantonius\\Hook\\Tests\\', __DIR__ . '/vendor/josantonius/hook/tests');

use Josantonius\Hook\Tests\HookTest;
```

Métodos de prueba disponibles:

```php
HookTest::testAddHooks();
HookTest::testSetSingletonName();
HookTest::testExecuteHooks();
HookTest::testSetOneHook();
HookTest::testSetMultipleHooks();
```

### Manejador de excepciones

Esta librería utiliza [control de excepciones](src/Exception) que puedes personalizar a tu gusto.
### Contribuir
1. Comprobar si hay incidencias abiertas o abrir una nueva para iniciar una discusión en torno a un fallo o función.
1. Bifurca la rama del repositorio en GitHub para iniciar la operación de ajuste.
1. Escribe una o más pruebas para la nueva característica o expón el error.
1. Haz cambios en el código para implementar la característica o reparar el fallo.
1. Envía pull request para fusionar los cambios y que sean publicados.

Esto está pensado para proyectos grandes y de larga duración.

### Repositorio

Los archivos de este repositorio se crearon y subieron automáticamente con [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Licencia

Este proyecto está licenciado bajo **licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más información.

## Copyright

2017 Josantonius, [josantonius.com](https://josantonius.com/)

Si te ha resultado útil, házmelo saber :wink:

Puedes contactarme en [Twitter](https://twitter.com/Josantonius) o a través de mi [correo electrónico](mailto:hello@josantonius.com).