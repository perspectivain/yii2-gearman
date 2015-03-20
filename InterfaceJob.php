<?php
namespace perspectivain\gearman;

interface InterfaceJob
{
    /**
     * @var array @attributes
     */
	public function run($attributes);
}
