<?php
namespace perspectivain\gearman;

class Gearman extends \yii\base\Component
{
    /**
     * @var array
     */
    public $servers;

    /**
     * @var string
     */
    public $jobsNamespace;

    /**
     * @var GearmanClient
     */
    protected $client;

    /**
     * @var GearmanWorker
     */
    protected $worker;

    /**
     * @return Object
     */
    protected function setServers($instance)
    {
        foreach ($this->servers as $s) {
            $instance->addServer($s['host'], $s['port']);
        }

        return $instance;
    }

    /**
     * @return GearmanClient
     */
    public function client()
    {
        if (!$this->client) {
            $this->client = $this->setServers(new \GearmanClient);
        }

        return $this->client;
    }

    /**
     * @return GearmanWorker
     */
    public function worker()
    {
        if (!$this->worker) {
            $this->worker = $this->setServers(new \GearmanWorker);
        }

        $this->worker->addOptions(GEARMAN_WORKER_GRAB_UNIQ);

        return $this->worker;
    }
}
