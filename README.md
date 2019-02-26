# laravel-exincore-sdk

![](https://img.shields.io/badge/Mixin-Network-2995f2.svg?style=for-the-badge&colorA=1cc2fd&longCache=true&logo=data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI0NSAyNDAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDI0NSAyNDA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojRkZGRkZGO30KPC9zdHlsZT4KPGc+Cgk8Zz4KCQk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNMjI3LjEsMzMuM2wtMzYuMywxNi4xYy0yLjIsMS4yLTMuNSwzLjUtMy41LDUuOXYxMjkuOGMwLDIuNSwxLjQsNC44LDMuNiw1LjlsMzYuMywxNS43YzIuMywxLjIsNS0wLjQsNS0zJiMxMDsmIzk7JiM5OyYjOTtWMzYuM0MyMzIuMSwzMy43LDIyOS4zLDMyLjEsMjI3LjEsMzMuM3ogTTUzLjMsNDkuMmwtMzUuMi0xNmMtMi4zLTEuMi01LDAuNC01LDN2MTY3LjRjMCwyLjcsMyw0LjMsNS4yLDIuOWwzNS40LTE4LjcmIzEwOyYjOTsmIzk7JiM5O2MyLTEuMiwzLjItMy40LDMuMi01Ljd2LTEyN0M1Ni44LDUyLjcsNTUuNSw1MC40LDUzLjMsNDkuMnogTTE2My43LDkzLjVsLTM3LjktMjEuN2MtMi4xLTEuMi00LjctMS4yLTYuNywwTDgwLjUsOTMuMyYjMTA7JiM5OyYjOTsmIzk7Yy0yLjEsMS4yLTMuNCwzLjUtMy40LDUuOXY0NGMwLDIuNCwxLjMsNC43LDMuNCw1LjlsMzguNiwyMi4yYzIuMSwxLjIsNC43LDEuMiw2LjcsMGwzNy45LTIyYzIuMS0xLjIsMy40LTMuNSwzLjQtNS45di00NCYjMTA7JiM5OyYjOTsmIzk7QzE2Ny4xLDk2LjksMTY1LjgsOTQuNywxNjMuNyw5My41eiIvPgoJPC9nPgo8L2c+Cjwvc3ZnPg==)

------

![](https://img.shields.io/badge/php-~7.0.0-green.svg?longCache=true&style=flat-square&colorA=333333)
![](https://img.shields.io/github/languages/code-size/Kurisu-package/laravel-exincore-sdk.svg?style=flat-square&colorA=333333)
![](https://img.shields.io/github/license/Kurisu-package/laravel-exincore-sdk.svg?style=flat-square&colorA=333333)
![](https://img.shields.io/github/tag/Kurisu-package/laravel-exincore-sdk.svg?style=flat-square&colorA=333333)


## Requirement
1. `Laravel` >= 5.1
2. `Composer`
3. `PHP` >= 7.0

## Installation

```bash
$ composer require kurisu/laravel-exincore-sdk -vvv
```

## 配置

1. 如果你的 Laravel >= `5.5`，可跳过第一步，从第二步开始即可。否则需要在 `config/app.php` 中注册 ServiceProvider 和 Facade。

```php
'providers' => [
    ...
    Kurisu\ExinCore\ExinCoreServiceProvider::class,
],
'aliases' => [
    ...
    'MixinSDK' => Kurisu\ExinCore\Facades\ExinCore::class,
]
```

1. 创建配置文件

```bash 
$ php artisan vendor:publish --provider="Kurisu\ExinCore\ExinCoreServiceProvider"
```

1. 填写配置，你可以选择如下几种方法中的一种来配置
    1. 填写 `config/exincore.php` 和 `.env` 配置
        ```php
        // 账号配置信息
           'mixin_id'      => env('MIXIN_SDK_MIXIN_ID'),       //
           'client_id'     => env('MIXIN_SDK_CLIENT_ID'),      //
           'client_secret' => env('MIXIN_SDK_CLIENT_SECRET'),  //
           'pin'           => env('MIXIN_SDK_PIN'),            //
           'pin_token'     => env('MIXIN_SDK_PIN_TOKEN'),      //
           'session_id'    => env('MIXIN_SDK_SESSION_ID'),     //
           'private_key'   => '',                              //import your private_key
        ```
        此后，调用时就自动载入以上配置。
    
        如果不想私钥被记录到 VCS 中，可以参考[此处](https://stackoverflow.com/questions/53415485/laravel-cant-get-pem-public-key-data-from-env-file)进行配置

    2. 你也可以不在 `config/exincore.php` 中进行任何配置，以如下方式调用即可
        ```php
        // 使用 setConfig 方法，保存配置
        ExinCore::getMixinSDK()->setConfig('default',$config);
        ```
    3. 你也可以在项目中封装自己的方法来更加方便的切换配置。

## 使用

### 例示

```php
// 1. 查询指定交易对的行情
$baseAsset     = 'c94ac88f-4671-3976-b60a-09064f1811e8';     // uuid
$exchangeAsset = '815b0b1a-2764-3736-8faa-42d694fa620a'; // uuid

ExinCore::readExchangeList();                            // 查询全部交易对的行情
ExinCore::readExchangeList($baseAsset);                  // 查询 baseAsset 为 $baseAsset 的交易对的行情
ExinCore::readExchangeList($baseAsset, $exchangeAsset);  // 查询 baseAsset 为 $baseAsset , exchangeAsset 为 $exchangeAsset 的交易对的行情


// 2. 创建订单
ExinCore::createOrder($baseAsset, $exchangeAsset, 1);
```

### 调用
|code|description
|---|---
|`ExinCore::readExchangeList($baseAsset = null, $exchangeAsset = null)`| 查询指定交易对的行情
|`ExinCore::createOrder($baseAsset, $exchangeAsset, $amount)`| 创建订单

## WARNING
有三个不太重要的可配置项
1. 是否需要返回原始响应体
    ```php
    ExinCore::setRaw(true);    // or false , 默认为 false
    ```

1. 如果 Mixin Network Api 返回错误码，是否抛出异常
    ```php
    ExinCore::setBoom(false);  // or true , 默认为 true
    ```

1. 设置网络请求超时时间
    ```php
    ExinCore::setTimeout(6);   // 默认为 10
    ```

## Alternatives

[[kurisu/exincore-php-sdk](https://github.com/Kurisu-package/exincore-php-sdk)]

## LICENSE

**MIT**
