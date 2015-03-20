<?php
namespace perspectivain\gearman;

class BackgroundJob
{
    const LOW = 0;
    const NORMAL = 1;
    const HIGH = 2;

    public static $path = 'default-cli';

    /**
    * Send an job to queue
    * Example: BackgroundJob::client('SendMailJob', ['subject' => 'Gearman', 'email' => 'rob@erval.com'], BackgroundJob::HIGH);
    * @param string $class
    * @param array $params
    * @param integer $priority
    * @param string $path
    * @return void
    */
    public static function register($class, $params = [], $priority = self::NORMAL, $path = null)
    {
        if($path) {
            self::setPath($path);
        }

        $client = Yii::app()->gearman->client();

        switch ($priority) {

            case self::HIGH:
                $client->doHighBackground(self::getPath(), serialize(['class' => $classe, 'params' => $params]));
            break;

            case self::LOW:
                $client->doLowBackground(self::getPath(), serialize(['classe' => $classe, 'params' => $params]));
            break;

            default:
                $client->doBackground(self::getPath(), serialize(['classe' => $classe, 'params' => $params]));
            break;
        }

        return;
    }

    /**
    * Get worker to work
    * @param string $path
    * @return worker
    */
    public static function worker($path)
    {
        if($path) {
            self::setPath($path);
        }

        $worker = Yii::$app->gearman->worker();
        $worker->addFunction(self::getPath(), ['BackgroundJob', 'processar']);
        return $worker;
    }

    /**
    * Clear one job
    * @param type $job
    * @return void
    */
    public static function doNothing($job)
    {
        $job->workload();
        return;
    }

    /**
    * Run one job
    * @param type $job
    * @return void
    */
    public static function run($job)
    {
        $attributes = unserialize($job->workload());
        $className = $attributes['class'];
        $model = new $className;
        $model->run($attributes['params']);
        return;
    }

    /**
    * @param string $path
    * @return void
    */
    public static function setPath($path)
    {
        self::$path = $path;
    }

    /**
    * @return string
    */
    public static function getPath()
    {
        return self::$path;
    }
}
