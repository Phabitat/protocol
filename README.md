# Protocol

A super lightweight abstraction layer for dealing with HTTP requests, responses and cookies. Comes with near-zero dependencies and a bunch of very useful HTTP constants. As every member in Phabitat family, Protocol is about doing only one thing well – allowing to parse and compose requests and responses. Unlike some popular libraries, it doesn't take responsibility for downloading or sending any data – that's not what an abstraction layer is about.

## Examples

```php
// Create request from superglobals.

$request    = SuperglobalsFactory::instance()->construct();
$ajax       = $request->isAjax();
$method     = $request->getMathod();
$parameters = $request->getParameters();

```
