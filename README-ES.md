# PHP Hook library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Hook/v/stable)](https://packagist.org/packages/josantonius/Hook) [![Latest Unstable Version](https://poser.pugx.org/josantonius/Hook/v/unstable)](https://packagist.org/packages/josantonius/Hook) [![License](https://poser.pugx.org/josantonius/Hook/license)](LICENSE) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/22a7928128324c3e8a7ca9ea4aa2abcb)](https://www.codacy.com/app/Josantonius/PHP-Hook?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Josantonius/PHP-Hook&amp;utm_campaign=Badge_Grade) [![Total Downloads](https://poser.pugx.org/josantonius/Hook/downloads)](https://packagist.org/packages/josantonius/Hook) [![Travis](https://travis-ci.org/Josantonius/PHP-Hook.svg)](https://travis-ci.org/Josantonius/PHP-Hook) [![PSR2](https://img.shields.io/badge/PSR-2-1abc9c.svg)](http://www.php-fig.org/psr/psr-2/) [![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](http://www.php-fig.org/psr/psr-4/) [![CodeCov](https://codecov.io/gh/Josantonius/PHP-Hook/branch/master/graph/badge.svg)](https://codecov.io/gh/Josantonius/PHP-Hook)

[English version](README.md)

Biblioteca para manejo de hooks.

---

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Métodos disponibles](#métodos-disponibles)
- [Cómo empezar](#cómo-empezar)
- [Uso](#uso)
- [Tests](#tests)
- [Tareas pendientes](#-tareas-pendientes)
- [Contribuir](#contribuir)
- [Repositorio](#repositorio)
- [Licencia](#licencia)
- [Copyright](#copyright)

---

## Requisitos

Esta clase es soportada por versiones de **PHP 5.6** o superiores y es compatible con versiones de **HHVM 3.0** o superiores.

## Instalación 

La mejor forma de instalar esta extensión es a través de [Composer](http://getcomposer.org/download/).

Para instalar **PHP Hook library**, simplemente escribe:

    $ composer require Josantonius/Hook

El comando anterior sólo instalará los archivos necesarios, si prefieres **descargar todo el código fuente** puedes utilizar:

    $ composer require Josantonius/Hook --prefer-source

También puedes **clonar el repositorio** completo con Git:

  $ git clone https://github.com/Josantonius/PHP-Hook.git

O **instalarlo manualmente**:

[Descargar Hook.php](https://raw.githubusercontent.com/Josantonius/PHP-Hook/master/src/Hook.php):

    $ wget https://raw.githubusercontent.com/Josantonius/PHP-Hook/master/src/Hook.php

## Métodos disponibles

Métodos disponibles en esta biblioteca:

### - Obtener instancia:

```php
Hook::getInstance();
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $id | ID único para multiples instancias. | string | No | '0' |

**# Return** (object) → instancia

### - Definir el nombre del método para usar el patrón singleton:

```php
Hook::setSingletonName($method);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $method | Definir el nombre del método para usar el patrón singleton. | callable | No | |

**# Return** (void)

### - Agregar función personalizado al gancho de acción:

```php
Hook::addAction($tag, $function, $priority, $args);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $tag | Nombre del gancho de acción. | string | Sí | |
| $function | Función donde insertar el gancho de acción. | callable | Sí | |
| $priority | Orden en que se ejecuta la acción. | int | No | 8 |
| $args | Número de argumentos aceptados. | int | No | 0 |

**# Return** (boolean)

### - Agregar acciones desde array:

```php
Hook::addActions($actions);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $actions | Acciones | array | Sí | |

**# Return** (boolean)

### - Ejecutar todos los ganchos de determinada acción:

Por defecto, buscará el método `getInstance()` para usar el patrón singleton y crear una única instancia de la clase. Si no existe, creará un nuevo objeto.

```php
Hook::doAction($tag, $args, $remove);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $tag | Nombre del gancho de acción. | string | Sí | |
| $args | Argumentos opcionales. | mixed | No | array() |
| $remove | Eliminar gancho después de ejecutar acciones | boolean | No | true |

**# Return** (mixed|false) → salida de la última acción o falso

### - Obtener el gancho de acción actual:

```php
Hook::current();
```

**# Return** (string|false) → gancho de acción actual

### - Comprobar si existe determinado gancho de acción:

```php
Hook::isAction($tag);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $tag | Nombre del gancho de acción | string | Sí | |

**# Return** (boolean)

## Cómo empezar

Para utilizar esta biblioteca, simplemente:

Para utilizar esta biblioteca con **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;
```

Si la instalaste **manualmente**, utiliza:

```php
require_once __DIR__ . '/Hook.php';

use Josantonius\Hook\Hook;
```

## Uso

### - Agregar gancho de acción:

```php
Hook::addAction('css', ['Josantonius\Hook\Test\Example', 'css']);
```

### - Agregar gancho de acción con prioridad:

```php
Hook::addAction('js', ['Josantonius\Hook\Test\Example', 'js'], 1);
```

### - Agregar gancho de acción con prioridad y número de argumentos:

```php
$instance = new Example;

Hook::addAction('meta', [$instance, 'meta'], 2, 1);
```

### - Agregar gancho de acción y definir patrón singleton:

```php
Hook::setSingletonName('singletonMethod');

$instance = call_user_func(
    'Josantonius\Hook\Test\Example::singletonMethod'
);

Hook::addAction('article', [$instance, 'article'], 3, 0);
```

### - Agregar múltiples ganchos de acción:

```php
$instance = new Example;
        
Hook::addActions([
    ['after-body', [$instance, 'afterBody'], 4, 0],
    ['footer', [$instance, 'footer'], 5, 0],
]);
```

### - Agregar múltiples ganchos de acción y definir patrón singleton:

```php
Hook::setSingletonName('singletonMethod');

$instance = call_user_func(
    'Josantonius\Hook\Test\Example::singletonMethod'
);

Hook::addActions([
    ['slide', [$instance, 'slide'], 6, 0],
    ['form', [$instance, 'form'], 7, 2],
]);
```

### - Comprobar si una acción ha sido definida:

```php
Hook::setSingletonName('singletonMethod');

Hook::isAction('meta');
```

### - Ejecutar ganchos de acción:

```php
Hook::doAction('css');
Hook::doAction('js');
Hook::doAction('after-body');
Hook::doAction('article');
Hook::doAction('footer');
```

### - Ejecutar ganchos de acción con argumentos:

```php
Hook::doAction('meta', 'The title');
Hook::doAction('form', ['input', 'select']);
```

## Tests 

Para ejecutar las [pruebas](tests) necesitarás [Composer](http://getcomposer.org/download/) y seguir los siguientes pasos:

    $ git clone https://github.com/Josantonius/PHP-Hook.git
    
    $ cd PHP-Hook

    $ composer install

Ejecutar pruebas unitarias con [PHPUnit](https://phpunit.de/):

    $ composer phpunit

Ejecutar pruebas de estándares de código [PSR2](http://www.php-fig.org/psr/psr-2/) con [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

    $ composer phpcs

Ejecutar pruebas con [PHP Mess Detector](https://phpmd.org/) para detectar inconsistencias en el estilo de codificación:

    $ composer phpmd

Ejecutar todas las pruebas anteriores:

    $ composer tests

## ☑ Tareas pendientes

- [ ] Añadir nueva funcionalidad.
- [ ] Mejorar pruebas.
- [ ] Mejorar documentación.
- [ ] Refactorizar código para las reglas de estilo de código deshabilitadas. Ver [phpmd.xml](phpmd.xml) y [.php_cs.dist](.php_cs.dist).

## Contribuir

Si deseas colaborar, puedes echar un vistazo a la lista de
[issues](https://github.com/Josantonius/PHP-Hook/issues) o [tareas pendientes](#-tareas-pendientes).

**Pull requests**

* [Fork and clone](https://help.github.com/articles/fork-a-repo).
* Ejecuta el comando `composer install` para instalar dependencias.
  Esto también instalará las [dependencias de desarrollo](https://getcomposer.org/doc/03-cli.md#install).
* Ejecuta el comando `composer fix` para estandarizar el código.
* Ejecuta las [pruebas](#tests).
* Crea una nueva rama (**branch**), **commit**, **push** y envíame un
  [pull request](https://help.github.com/articles/using-pull-requests).

## Repositorio

La estructura de archivos de este repositorio se creó con [PHP-Skeleton](https://github.com/Josantonius/PHP-Skeleton).

## Licencia

Este proyecto está licenciado bajo **licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más información.

## Copyright

2017 - 2018 Josantonius, [josantonius.com](https://josantonius.com/)

Si te ha resultado útil, házmelo saber :wink:

Puedes contactarme en [Twitter](https://twitter.com/Josantonius) o a través de mi [correo electrónico](mailto:hello@josantonius.com).