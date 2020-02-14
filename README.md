# UuidEncoder

This library is used to encode UUIDs created by [ramsey/uuid][ramsey-uuid] into shorter strings. You are able to define the set of characters used in the encoded string.

## Installation

The preferred method of installation is via Composer. Run the following command to install the package and add it as a requirement to your project's `composer.json`:

```bash
composer require gubler/uuid-encoder
```

## Use

```php
<?php

use Ramsey\Uuid\Uuid;
use Gubler\UuidEncoder\UuidEncoder;

$uuid = Uuid::uuid4();
$encoder = new UuidEncoder(UuidEncoder::DEFAULT_CHARSET);

$encodedString = $encoder->encode($uuid);
```




## Contributing

Contributions are welcome! Please read [CONTRIBUTING][contributing] for details.

This project adheres to a [Contributor Code of Conduct][conduct]. By participating in this project and its community, you are expected to uphold this code.

## Copyright and License

The `gubler/uuid-encoder` library is copyright © [Daryl Gubler](http://dev88.co/) and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.

[ramsey-uuid]: https://github.com/ramsey/uuid
[conduct]: https://github.com/gubler/uuid-encoder/blob/master/CODE_OF_CONDUCT.md
[composer]: http://getcomposer.org/
[contributing]: https://github.com/gubler/uuid-encoder/blob/master/CONTRIBUTING.md
[source]: https://github.com/gubler/uuid-encoder
[release]: https://packagist.org/packages/gubler/uuid-encoder
[license]: https://github.com/gubler/uuid-encoder/blob/master/LICENSE
[build]: https://travis-ci.org/gubler/uuid-encoder
[coverage]: https://coveralls.io/r/gubler/uuid-encoder?branch=master
[downloads]: https://packagist.org/packages/gubler/uuid-encoder
