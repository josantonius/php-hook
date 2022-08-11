# PHP Hook library

[![Latest Stable Version](https://poser.pugx.org/josantonius/hook/v/stable)](https://packagist.org/packages/josantonius/hook)
[![License](https://poser.pugx.org/josantonius/hook/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/hook/downloads)](https://packagist.org/packages/josantonius/hook)
[![CI](https://github.com/josantonius/php-hook/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-hook/actions/workflows/ci.yml)
[![CodeCov](https://codecov.io/gh/josantonius/php-hook/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-hook)
[![PSR1](https://img.shields.io/badge/PSR-1-f57046.svg)](https://www.php-fig.org/psr/psr-1/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](https://www.php-fig.org/psr/psr-4/)
[![PSR12](https://img.shields.io/badge/PSR-12-1abc9c.svg)](https://www.php-fig.org/psr/psr-12/)

**Traducciones**: [English](/README.md)

Biblioteca para manejo de hooks en PHP.

---

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Clases disponibles](#clases-disponibles)
  - [Instancia Action](#instancia-action)
  - [Clase Hook](#clase-hook)
  - [Clase Priority](#clase-priority)
- [Excepciones utilizadas](#excepciones-utilizadas)
- [Uso](#uso)
- [Tests](#tests)
- [Tareas pendientes](#tareas-pendientes)
- [Registro de Cambios](#registro-de-cambios)
- [Contribuir](#contribuir)
- [Patrocinar](#patrocinar)
- [Licencia](#licencia)

---

## Requisitos

Esta biblioteca es compatible con las versiones de PHP: 8.1.

## Instalación

La mejor forma de instalar esta extensión es a través de [Composer](http://getcomposer.org/download/).

Para instalar **PHP Hook library**, simplemente escribe:

```console
composer require josantonius/hook
```

El comando anterior solo instalará los archivos necesarios, si prefieres **descargar todo el código fuente** puedes utilizar:

```console
composer require josantonius/hook --prefer-source
```

También puedes **clonar el repositorio** completo con Git:

```console
git clone https://github.com/josantonius/php-hook.git
```

## Clases disponibles

### Instancia Action

```php
use Josantonius\Hook\Action;
```

Obtener el nivel de prioridad de la acción:

```php
$action->getPriority(): int
```

Obtener el resultado de la llamada a la acción:

```php
$action->getResult(): mixed
```

Comprueba si la acción se realiza solo una vez:

```php
$action->isOnce(): bool
```

Comprueba si la acción ya se ha realizado:

```php
$action->wasDone(): bool
```

### Clase Hook

```php
use Josantonius\Hook\Hook;
```

Registrar nuevo gancho:

```php
$hook = new Hook(string $name);
```

Agregar acción en el gancho:

```php
/**
 * La acción se mantendrá después de realizar las acciones y estará disponible si se hacen de nuevo.
 * 
 * @see https://www.php.net/manual/en/functions.first_class_callable_syntax.php
 * 
 * @return Action Acción agregada.
 */
$hook->addAction(callable $callback, int $priority = Priority::NORMAL): Action
```

Agregar acción en el gancho una vez:

```php
/**
 * La acción solo se realizará una vez y se borrará una vez realizada.
 * 
 * Se recomienda utilizar este método para liberar las acciones de la
 * memoria si las acciones del gancho solo se van a realizar una vez.
 * 
 * @return Action Acción agregada.
 */
$hook->addActionOnce(callable $callback, int $priority = Priority::NORMAL): Action
```

Ejecutar las acciones agregadas al gancho:

```php
/**
 * @throws HookException si las acciones ya se han realizado.
 * @throws HookException si no se han añadido acciones para el gancho.
 * 
 * @return Action[] Acciones hechas.
 */
$hook->doActions(mixed ...$arguments): Action[]
```

Comprueba si el gancho tiene acciones:

```php
/**
 * Verdadero si el gancho tiene alguna acción incluso si la acción
 * se ha hecho antes (acciones recurrentes creadas con addAction).
 */
$hook->hasActions(): bool
```

Comprueba si el gancho tiene acciones sin realizar:

```php
/**
 * Verdadero si el gancho tiene alguna acción sin realizar.
 */
$hook->hasUndoneActions(): bool
```

Comprueba si las acciones se han realizado al menos una vez:

```php
/**
 * Si doActions fue ejecutado al menos una vez.
 */
$hook->hasDoneActions(): bool
```

Obtener el nombre del hook:

```php
$hook->getName(): string
```

### Priority Class

Constantes disponibles:

```php
Priority::HIGHEST; // 50
Priority::HIGH;    // 100
Priority::NORMAL;  // 150
Priority::LOW;     // 200
Priority::LOWEST;  // 250
```

## Excepciones utilizadas

```php
use Josantonius\Hook\Exceptions\HookException;
```

## Uso

Ejemplos de uso de esta biblioteca:

### Registrar nuevo gancho

```php
$hook = new Hook('foo');
```

### Agregar acciones en el gancho

```php
use Josantonius\Hook\Hook;

class Foo {
    public static function bar() { /* hacer algo */ }
    public static function baz() { /* hacer algo */ }
}

$hook = new Hook('name');

$hook->addAction(Foo::bar(...));
$hook->addAction(Foo::baz(...));
```

### Agregar acciones con prioridad personalizada en el gancho

```php
use Josantonius\Hook\Hook;
use Josantonius\Hook\Priority;

class Foo {
    public static function bar() { /* hacer algo */ }
    public static function baz() { /* hacer algo */ }
}

$hook = new Hook('name');

$hook->addAction(Foo::bar(...), Priority::LOW);
$hook->addAction(Foo::baz(...), Priority::HIGH);
```

### Agregar acciones en el gancho una vez

```php
use Josantonius\Hook\Hook;

class Foo {
    public function bar() { /* hacer algo */ }
    public function baz() { /* hacer algo */ }
}

$foo  = new Foo();
$hook = new Hook('name');

$hook->addActionOnce($foo->bar(...));
$hook->addActionOnce($foo->baz(...));
```

### Agregar acciones una vez con prioridad personalizada en el gancho

```php
use Josantonius\Hook\Hook;
use Josantonius\Hook\Priority;

class Foo {
    public function bar() { /* hacer algo */ }
    public function baz() { /* hacer algo */ }
}

$foo  = new Foo();
$hook = new Hook('name');

$hook->addActionOnce($foo->bar(...), Priority::LOW);
$hook->addActionOnce($foo->baz(...), Priority::HIGH);
```

### Realizar acciones con la misma prioridad

```php
use Josantonius\Hook\Hook;

function one() { /* hacer algo */ }
function two() { /* hacer algo */ }

$hook = new Hook('name');

$hook->addAction(one(...));
$hook->addAction(two(...));

/**
 * Las acciones se ejecutarán según su orden natural:
 * 
 *  one(), two()...
 */
$hook->doActions();
```

### Realizar acciones con diferente prioridad

```php
use Josantonius\Hook\Hook;
use Josantonius\Hook\Priority;

function a() { /* hacer algo */ }
function b() { /* hacer algo */ }
function c() { /* hacer algo */ }

$hook = new Hook('name');

$hook->addAction(a(...), priority::LOW);
$hook->addAction(b(...), priority::NORMAL);
$hook->addAction(c(...), priority::HIGHEST);

/**
 * Las acciones se ejecutarán según su prioridad:
 * 
 * c(), b(), a()...
 */
$hook->doActions();
```

### Realizar acciones con argumentos

```php
use Josantonius\Hook\Hook;

function foo($foo, $bar) { /* hacer algo */ }

$hook = new Hook('name');

$hook->addAction(foo(...));

$hook->doActions('foo', 'bar');
```

### Realizar acciones de forma recurrente

```php
use Josantonius\Hook\Hook;

function a() { /* hacer algo */ }
function b() { /* hacer algo */ }
function c() { /* hacer algo */ }

$hook = new Hook('name');

$hook->addAction(a(...));
$hook->addAction(b(...));
$hook->addActionOnce(c(...)); // Se hará una sola vez

$hook->doActions(); // a(), b(), c()

$hook->doActions(); // a(), b()
```

### Realizar las acciones solo una vez

```php
use Josantonius\Hook\Hook;

function one() { /* hacer algo */ }
function two() { /* hacer algo */ }

$hook = new Hook('name');

$hook->addActionOnce(one(...));
$hook->addActionOnce(tho(...));

$hook->doActions();

// $hook->doActions(); Lanzaría una excepción ya que no hay acciones que realizar
```

### Comprueba si el gancho tiene acciones

```php
use Josantonius\Hook\Hook;

function foo() { /* hacer algo */ }

$hook = new Hook('name');

$hook->addAction(foo());

$hook->hasActions(); // Verdadero

$hook->doActions();

$hook->hasActions(); // Verdadero ya que la acción es recurrente y permanece almacenada
```

### Comprueba si el gancho tiene acciones sin realizar

```php
use Josantonius\Hook\Hook;

function foo() { /* hacer algo */ }

$hook = new Hook('name');

$hook->addAction(foo());

$hook->hasUndoneActions(); // Verdadero

$hook->doActions();

$hook->hasUndoneActions(); // Falso ya que no hay acciones no realizadas
```

### Comprueba si las acciones se han realizado al menos una vez

```php
use Josantonius\Hook\Hook;

function foo() { /* hacer algo */ }

$hook = new Hook('name');

$hook->addAction(foo());

$hook->hasDoneActions(); // Falso

$hook->doActions();

$hook->hasDoneActions(); // Verdadero ya que las acciones se hicieron
```

### Obtener el nombre del hook

```php
use Josantonius\Hook\Hook;

$hook = new Hook('foo');

$name = $hook->getName(); // foo
```

#### Obtener el nivel de prioridad de la acción

```php
use Josantonius\Hook\Hook;

function foo() { /* hacer algo */ }

$hook = new Hook('name');

$action = $hook->addAction(foo());

$action->getPriority();
```

#### Obtener el resultado de la llamada a la acción

```php
use Josantonius\Hook\Hook;

function foo() { /* hacer algo */ }

$hook = new Hook('name');

$action = $hook->addAction(foo());

$action->getResult();
```

#### Comprueba si la acción se realiza solo una vez

```php
use Josantonius\Hook\Hook;

function foo() { /* hacer algo */ }

$hook = new Hook('name');

$action = $hook->addAction(foo());

$action->isOnce(); // Falso

$action = $hook->addActionOnce(foo());

$action->isOnce(); // Verdadero
```

#### Comprueba si la acción ya se ha realizado

```php
use Josantonius\Hook\Hook;

function foo() { /* hacer algo */ }

$hook = new Hook('name');

$action = $hook->addAction(foo());

$action->wasDone(); // Falso

$hook->doActions();

$action->wasDone(); // Verdadero
```

## Tests

Para ejecutar las [pruebas](tests) necesitarás [Composer](http://getcomposer.org/download/)
y seguir los siguientes pasos:

```console
git clone https://github.com/josantonius/php-hook.git
```

```console
cd php-hook
```

```console
composer install
```

Ejecutar pruebas unitarias con [PHPUnit](https://phpunit.de/):

```console
composer phpunit
```

Ejecutar pruebas de estándares de código con [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

```console
composer phpcs
```

Ejecutar pruebas con [PHP Mess Detector](https://phpmd.org/) para detectar inconsistencias
en el estilo de codificación:

```console
composer phpmd
```

Ejecutar todas las pruebas anteriores:

```console
composer tests
```

## Tareas pendientes

- [ ] Añadir nueva funcionalidad
- [ ] Mejorar pruebas
- [ ] Mejorar documentación
- [ ] Mejorar la traducción al inglés en el archivo README
- [ ] Refactorizar código para las reglas de estilo de código deshabilitadas
(ver [phpmd.xml](phpmd.xml) y [phpcs.xml](phpcs.xml))
- [ ] Hacer que Action->runCallback() sea accesible sólo para la clase Hook
- [ ] ¿Agregar un método para eliminar una acción?
- [ ] ¿Agregar la opción de añadir ID en las acciones?

## Registro de Cambios

Los cambios detallados de cada versión se documentan en las
[notas de la misma](https://github.com/josantonius/php-hook/releases).

## Contribuir

Por favor, asegúrate de leer la [Guía de contribución](CONTRIBUTING.md) antes de hacer un
_pull request_, comenzar una discusión o reportar un _issue_.

¡Gracias por [colaborar](https://github.com/josantonius/php-hook/graphs/contributors)! :heart:

## Patrocinar

Si este proyecto te ayuda a reducir el tiempo de desarrollo,
[puedes patrocinarme](https://github.com/josantonius/lang/es-ES/README.md#patrocinar)
para apoyar mi trabajo :blush:

## Licencia

Este repositorio tiene una licencia [MIT License](LICENSE).

Copyright © 2017-actualidad, [Josantonius](https://github.com/josantonius/lang/es-ES/README.md#contacto)
