<?php
namespace Redefinitions\Errors;
/**
 * Created by IntelliJ IDEA.
 * Author: Andru Cherny
 * E-mail: wiroatom[dogg]gmail[dot]com
 * Date: 02.11.15
 * Time: 13:19
 */

use yii\base\ErrorException;
use yii\base\UserException;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class Handler
 */
class Handler implements HandlerInterface
{
    /**
     * @param HttpException $exception
     * @return mixed
     */
    public static function catchHttpException(HttpException $exception)
    {
        $response = \Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = [
            'statusCode' => $exception->statusCode,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode()
        ];
        $response->send();

    }

    /**
     * @param UserException $exception
     * @return mixed
     */
    public static function catchUserException(UserException $exception)
    {
        $response = \Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = [
            'statusCode' => $exception->statusCode,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode()
        ];
        $response->send();

    }

    /**
     * @param \Exception $exception
     */
    public static function catchErrorException(\Exception $exception)
    {
        $response = \Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode()
        ];
        $response->send();

    }
}