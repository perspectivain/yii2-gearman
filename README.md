Yii2 Gearman
=======
Component for use gearman server as consumer jobs

UNDER DEVELOPMENT

Usage
=======

Register a component

```
'components' => [
    'gearman' => [
        'class' => 'perspectivain/gearman/Gearman',
        'servers' => [
            ['host' => GEARMAN_SERVER_HOST, 'port' => GEARMAN_SERVER_PORT],
        ],
        'jobsNamespace' => 'app/jobs',
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
perspectivain\gearman\BackgroundJob::register('MyJob', ['attributeA' => 10]);
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
