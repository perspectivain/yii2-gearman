<?php

namespace perspectivain/yii-gearman;

class WorkeQueuerCommand extends CConsoleCommand 
{

	/**
	 * Run one job on queue
	 * @return void
	 */	
	public function actionRunOne() 
	{
		$worker = BackgroundJob::worker();
		$worker->setTimeout(30000);
		try {
			$worker->work();
		} catch (ErrorException $e) {}
	}
	
	/**
	 * Run all queue
	 * @param string $path
	 * @return void
	 */	
	public function actionRunAll($path = null) 
	{
		$worker = BackgroundJob::worker($path);
		while($worker->work()) { 
  
		}
	}
	
	/**
	 * Clear one job
	 * @return void
	 */	
	public function actionClearOne()
	{
		$worker = BackgroundJob::workerClearQueue();
		$worker->work();
	}
}

?>
