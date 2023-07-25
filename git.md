# Router

    to static setLayout()

## Router SetLayout()

```php
  public static function setLayout(string $layout_dir)
  {
    return self::$router->response::$LAYOUT_MAIN = $layout_dir;
  }
```

## Router InterceptRequest()

```php
public function interceptRequest($path = null)
  {
    $server_root = str_replace('\\', "/", strtolower($_SERVER['DOCUMENT_ROOT']));
    $app_root = str_replace('\\', "/", strtolower(self::$ROOT_DIR));

    $route = str_replace($server_root, '', $app_root);

    $path = $path ?? $this->request->path();

    if (!str_contains($path, '_/')) return;
    $path = explode('_/', $path);
    $path = '/' . end($path);

    $route = $route . $path;
    $this->response->redirect($route, 200);
  }
```

## Use send to resent text content on reponse instead of content

## Delete Post File form mvc core

## Add session module to mvc core

## Database

## BaseModel

## Router -> root_folder()

## Request -> sanitizeData() -> string

## Router Confused

    "/resume/{resume_id}"
    "/resume/create/{resume_id}"

## Use Sessions on registration to tack process and verificatoin with form handling
