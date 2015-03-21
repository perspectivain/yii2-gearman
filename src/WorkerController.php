<?php

namespace perspectivain\gearman;

use Yii;
use yii\console\Controller;

class WorkerController extends Controller
{
	/**
	 * Run one job on queue
	 * @return void
	 */
	public function actionRunOne($path = null)
	{
		$worker = BackgroundJob::worker($path);
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
}
