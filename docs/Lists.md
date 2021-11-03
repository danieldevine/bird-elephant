# Lists

```php
//create a list
$list = $twitter->lists()->create('test', 'testing', false);

//update a list
$list = $twitter->lists()->update('1455521029158277121', 'test', 'testing', false);

//add a memeber to a list
$member = $twitter->lists()->members()->add('1455521029158277121', 'coderjerk');

//remove a member from a list
$dismember = $twitter->lists()->members()->remove('1455521029158277121', 'coderjerk');

```
