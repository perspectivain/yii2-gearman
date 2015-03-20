Yii2 Gearman
=======
Component for use gearman server as consumer jobs

Deprecated if Yii2 Queue Component (https://github.com/yiisoft/yii2/issues/492) was accepted

UNDER DEVELOPMENT

Usage
=======

Register a component

```
'components' => [
    'gearman' => [
        'class' => 'perspectivain\gearman\Gearman',
        'jobsNamespace' => 'app/jobs',
        'servers' => [
            ['host' => GEARMAN_SERVER_HOST, 'port' => GEARMAN_SERVER_PORT],
        ],
    ],
    ...
],
```


Create an job class

```
namespace app\jobs;

class MyJob implements perspectivain\gearman\InterfaceJob
{
    /**
     * @inheritdoc
     */
    public function run($attributes)
    {
        //do something
    }
}
```


Register an job in your application

```
Yii::$app->gearman->register('MyJob', ['attributeA' => 10]);
```

Run the worker

```
# ./yii worker/run-one
```

If your need continuous worker, use the crontab or the supervisor process control system (http://supervisord.org/).

Installing
======
The preferred way to install this extension is through composer.

```
{
  "require": {
    "perspectivain/yii2-gearman": "*"
  }
}
```
