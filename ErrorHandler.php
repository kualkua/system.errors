<?php
/**
 * Created by IntelliJ IDEA.
 * Author: Andru Cherny
 * E-mail: wiroatom[dogg]gmail[dot]com
 * Date: 23.10.15
 * Time: 13:16
 */

namespace Redefinitions\Errors;


use yii\base\UserException;
use yii\web\ErrorHandler as yiiErrorHandler;
use Yii;
use yii\web\HttpException;

/**
 * Class ErrorHandler
 *
 * @package app\System\Errors
 */
class ErrorHandler extends yiiErrorHandler
{
    public $handlerClass;


    /**
     * @param array $config
     * @throws \Exception
     */
    public function __construct($config = [])
    {

        if(!isset($config['handlerClass']))
        {
          throw new \Exception('handlerClass is undefined');
        }
        $testInterface = new \ReflectionClass($config['handlerClass']);
        if($testInterface->implementsInterface('\Redefinitions\Errors\HandlerInterface') == false)
        {
            throw new \Exception('handlerClass :'.$config['handlerClass'].' is not implement \Redefinitions\Errors\HandlerInterface');
        }

        parent::__construct($config);
    }

	/**
	 * @inheridoc
	 *
	 * @param \Exception $exception
	 */
	protected function renderException($exception)
	{
        if(env('exception_overwrite_handler',false) == false)
        {
            parent::renderException($exception);
            return;
        }
        /** @var \app\System\Errors\HandlerInterface $handlerClass */
        $handlerClass = $this->handlerClass;
		if($exception instanceof HttpException)
		{
            $handlerClass::catchHttpException($exception);
		}
        elseif($exception instanceof UserException)
        {
            $handlerClass::catchUserException($exception);
        }
		else
		{
            $handlerClass::catchErrorException($exception);
		}
        return;
	}
}