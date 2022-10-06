# Code editor extension for laravel-admin

This is a `laravel-admin` extension that integrates [CodeMirror](https://github.com/codemirror/CodeMirror) into `laravel-admin`.

## Installation

First, install dependencies:
```bash
composer require gioco-plus/code-mirror-editor
```

Then, publish the resource directory:
```bash
php artisan vendor:publish --tag=laravel-admin-code-mirror-editor
```

## Configuration

In the `extensions` section of the `config/admin.php` file, add some configuration that belongs to this extension.
```php

    'extensions' => [

        'code-mirror-editor' => [
        
            // Set to false if you want to disable this extension
            'enable' => true,
            
            // Editor configuration
            'config' => [
                
            ]
        ]
    ]

```
The configuration of the editor can be found in [CodeMirror Docmentation](https://codemirror.net/)
## 使用

在form表单中使用它：
```php
$form->codeMirrorEditor('code');

// alias of `js` method
$form->cme('code');

// alias of `html` method
$form->cmeHtml('code');
```

Set height
```php
$form->codeMirrorEditor('code')->height(500);
```

## More resources

[Awesome Laravel-admin](https://github.com/jxlwqq/awesome-laravel-admin)


License
------------
Licensed under [The MIT License (MIT)](LICENSE).
