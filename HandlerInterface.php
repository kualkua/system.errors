<?php
/**
 * Created by IntelliJ IDEA.
 * Author: Andru Cherny
 * E-mail: wiroatom[dogg]gmail[dot]com
 * Date: 02.11.15
 * Time: 13:21
 */

namespace Redefinitions\Errors;

use yii\base\ErrorException;
use yii\base\UserException;
use yii\web\HttpException;

/**
 * Interface HandlerInterface
 * @package app\Components\Exception
 */
interface HandlerInterface
{


    /**
     * @param HttpException $exception
     * @return mixed
     */
    public static function catchHttpException(HttpException $exception);

    /**
     * @param UserException $exception
     * @return mixed
     */
    public static function catchUserException(UserException $exception);

    /**
     * @param \Exception $exception
     * @return mixed
     */
    public static function catchErrorException(\Exception $exception);
}