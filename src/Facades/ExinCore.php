<?php
/**
 * Created by PhpStorm.
 * User: kurisu
 * Date: 18-11-12
 * Time: 下午12:20
 */

namespace Kurisu\ExinCore\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see \Kurisu\ExinCore\ExinCore
 *
 * @method static setRaw(bool $isRaw)
 * @method static setBoom(bool $isBoom)
 * @method static setTimeout(int $timeout)
 * @method static getConfig():array
 * @method static getMixinAccountConfig(): array
 *
 *
 * @see \Kurisu\ExinCore\Apis\Api
 *
 * @method static createOrder($baseAsset, $exchangeAsset, $amount): array
 * @method static readExchangeList($baseAssetUuid = null, $exchangeAssetUuid = null): array
 *
 * @see \ExinOne\MixinSDK\MixinSDK
 */
class ExinCore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-exincore-sdk';
    }
}
