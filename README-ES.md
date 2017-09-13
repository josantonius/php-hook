# PHP Hook library

[![Latest Stable Version](https://poser.pugx.org/josantonius/hook/v/stable)](https://packagist.org/packages/josantonius/hook) [![Total Downloads](https://poser.pugx.org/josantonius/hook/downloads)](https://packagist.org/packages/josantonius/hook) [![Latest Unstable Version](https://poser.pugx.org/josantonius/hook/v/unstable)](https://packagist.org/packages/josantonius/hook) [![License](https://poser.pugx.org/josantonius/hook/license)](https://packagist.org/packages/josantonius/hook) [![Travis](https://travis-ci.org/Josantonius/PHP-Hook.svg)](https://travis-ci.org/Josantonius/PHP-Hook)

[English version](README.md)

Biblioteca para manejo de hooks.

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

El comando anterior sólo instalará los archivos necesarios, si prefieres descargar todo el código fuente (incluyendo tests, directorio vendor, excepciones no utilizadas, documentos...) puedes utilizar:

    $ composer require Josantonius/Hook --prefer-source

También puedes clonar el repositorio completo con Git:

	$ git clone https://github.com/Josantonius/PHP-Hook.git

### Requisitos

Esta biblioteca es soportada por versiones de PHP 5.6 o superiores y es compatible con versiones de HHVM 3.0 o superiores.

Para utilizar esta biblioteca en HHVM (HipHop Virtual Machine) tendrás que activar los tipos escalares. Añade la siguiente ĺínea "hhvm.php7.scalar_types = true" en tu "/etc/hhvm/php.ini".

### Cómo empezar y ejemplos

Para utilizar esta biblioteca, simplemente:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;
```
### Métodos disponibles

Métodos disponibles en esta biblioteca:


**getInstance()**
```php
Hook::getInstance();
```

**setSingletonName()**
```php
Hook::setSingletonName($method);
```

| Atributo | Descripción | Tipo | Requerido | Por defecto
| --- | --- | --- | --- | --- |
| $method | Establecer el nombre del método para utilizar el patrón singleton | string | Sí | |

**addAction()**
```php
Hook::addAction($tag, $function, $priority, $args);
```

| Atributo | Descripción | Tipo | Requerido | Por defecto
| --- | --- | --- | --- | --- |
| $tag | Nombre del gancho de acción | string | Sí | |
| $function | Función donde insertat el gancho de acción | callable | Sí | |
| $priority | Orden en que se ejecuta la acción | int | No | 8 |
| $args | Establecer el nombre del método para utilizar el patrón singleton | int | No | 0 |

**addActions()**
```php
Hook::addActions($actions);
```

| Atributo | Descripción | Tipo | Requerido | Por defecto
| --- | --- | --- | --- | --- |
| $actions | Acciones | array | Sí | |

**doAction()**
```php
Hook::doAction($tag, $args, $remove);
```

| Atributo | Descripción | Tipo | Requerido | Por defecto
| --- | --- | --- | --- | --- |
| $tag | Nombre del gancho de acción | string | Sí | |
| $args | Argumentos opcionales | mixed | No | array() |
| $remove | Eliminar gancho después de ejecutar acciones | boolean | No | true |

**current()**
```php
Hook::current();
```

### Uso

Ejemplo de uso para esta biblioteca:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Hook\Hook;

/* Agregar acciones */

Hook::addAction('css', ['Namespace\Class\Example', 'css'], 2, 0);

$hooks = [
    ['meta',       ['Namespace\Class\Example', 'meta'],      1, 0],
    ['js',         ['Namespace\Class\Example', 'js'],        3, 0],
    ['after-body', ['Namespace\Class\Example', 'afterBody'], 4, 0],
    ['footer',     ['Namespace\Class\Example', 'footer'],    5, 0],
];

Hook::addActions($hooks);

/* Ejecutar acciones */

Hook::doAction('meta');
Hook::doAction('css');
Hook::doAction('js');
Hook::doAction('after-body');
Hook::doAction('footer');
```

### Tests 

Para ejecutar las [pruebas](tests/Hook/test) simplemente:

    $ git clone https://github.com/Josantonius/PHP-Hook.git
    
    $ cd PHP-Hook

    $ phpunit

### Manejador de excepciones

Esta biblioteca utiliza [control de excepciones](src/Exception) que puedes personalizar a tu gusto.
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

### Copyright

2017 Josantonius, [josantonius.com](https://josantonius.com/)

Si te ha resultado útil, házmelo saber :wink:

Puedes contactarme en [Twitter](https://twitter.com/Josantonius) o a través de mi [correo electrónico](mailto:hello@josantonius.com).