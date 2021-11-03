# Lists

```php
$lists = $twitter->user('coderjerk')->lists()->follow('1441162269824405510');
```
```php
$lists = $twitter->user('coderjerk')->lists()->unfollow('1441162269824405510');
```

```php
$list = $twitter->lists()->create('test', 'testing', false);
```

```php
$list = $twitter->lists()->update('1455521029158277121', 'test', 'testing', false);
```

```php
$member = $twitter->lists()->members()->add('1455521029158277121', 'coderjerk');
```

```php
$dismember = $twitter->lists()->members()->remove('1455521029158277121', 'coderjerk');

```
