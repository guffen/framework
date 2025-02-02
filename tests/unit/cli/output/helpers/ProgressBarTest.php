<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\tests\unit\cli\output\helpers;

use mako\cli\output\helpers\ProgressBar;
use mako\cli\output\Output;
use mako\tests\TestCase;
use Mockery;

/**
 * @group unit
 */
class ProgressBarTest extends TestCase
{
	/**
	 *
	 */
	public function testProgressWithZeroItems(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->never();

		$progressBar = new ProgressBar($output, 0);

		$progressBar->draw();
	}

	/**
	 *
	 */
	public function testBasicProgress(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->once()->with("\r00/10 --------------------   0% ");
		$output->shouldReceive('write')->once()->with("\r01/10 ==------------------  10% ");
		$output->shouldReceive('write')->once()->with("\r02/10 ====----------------  20% ");
		$output->shouldReceive('write')->once()->with("\r03/10 ======--------------  30% ");
		$output->shouldReceive('write')->once()->with("\r04/10 ========------------  40% ");
		$output->shouldReceive('write')->once()->with("\r05/10 ==========----------  50% ");
		$output->shouldReceive('write')->once()->with("\r06/10 ============--------  60% ");
		$output->shouldReceive('write')->once()->with("\r07/10 ==============------  70% ");
		$output->shouldReceive('write')->once()->with("\r08/10 ================----  80% ");
		$output->shouldReceive('write')->once()->with("\r09/10 ==================--  90% ");
		$output->shouldReceive('write')->once()->with("\r10/10 ==================== 100% ");
		$output->shouldReceive('write')->once()->with(PHP_EOL);

		$progressBar = new ProgressBar($output, 10);

		$progressBar->draw();

		for($i = 0; $i < 10; $i++)
		{
			$progressBar->advance();
		}
	}

	/**
	 *
	 */
	public function testProgressWithCustomWidth(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->once()->with("\r00/10 ----------------------------------------   0% ");
		$output->shouldReceive('write')->once()->with("\r01/10 ====------------------------------------  10% ");
		$output->shouldReceive('write')->once()->with("\r02/10 ========--------------------------------  20% ");
		$output->shouldReceive('write')->once()->with("\r03/10 ============----------------------------  30% ");
		$output->shouldReceive('write')->once()->with("\r04/10 ================------------------------  40% ");
		$output->shouldReceive('write')->once()->with("\r05/10 ====================--------------------  50% ");
		$output->shouldReceive('write')->once()->with("\r06/10 ========================----------------  60% ");
		$output->shouldReceive('write')->once()->with("\r07/10 ============================------------  70% ");
		$output->shouldReceive('write')->once()->with("\r08/10 ================================--------  80% ");
		$output->shouldReceive('write')->once()->with("\r09/10 ====================================----  90% ");
		$output->shouldReceive('write')->once()->with("\r10/10 ======================================== 100% ");
		$output->shouldReceive('write')->once()->with(PHP_EOL);

		$progressBar = new ProgressBar($output, 10);

		$progressBar->setWidth(40);

		$progressBar->draw();

		for($i = 0; $i < 10; $i++)
		{
			$progressBar->advance();
		}
	}

	/**
	 *
	 */
	public function testProgressWithCustomTemplates(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->once()->with("\r00/10 ____________________   0% ");
		$output->shouldReceive('write')->once()->with("\r01/10 ++__________________  10% ");
		$output->shouldReceive('write')->once()->with("\r02/10 ++++________________  20% ");
		$output->shouldReceive('write')->once()->with("\r03/10 ++++++______________  30% ");
		$output->shouldReceive('write')->once()->with("\r04/10 ++++++++____________  40% ");
		$output->shouldReceive('write')->once()->with("\r05/10 ++++++++++__________  50% ");
		$output->shouldReceive('write')->once()->with("\r06/10 ++++++++++++________  60% ");
		$output->shouldReceive('write')->once()->with("\r07/10 ++++++++++++++______  70% ");
		$output->shouldReceive('write')->once()->with("\r08/10 ++++++++++++++++____  80% ");
		$output->shouldReceive('write')->once()->with("\r09/10 ++++++++++++++++++__  90% ");
		$output->shouldReceive('write')->once()->with("\r10/10 ++++++++++++++++++++ 100% ");
		$output->shouldReceive('write')->once()->with(PHP_EOL);

		$progressBar = new ProgressBar($output, 10);

		$progressBar->setEmptyTemplate('_');

		$progressBar->setFilledTemplate('+');

		$progressBar->draw();

		for($i = 0; $i < 10; $i++)
		{
			$progressBar->advance();
		}
	}

	/**
	 *
	 */
	public function testProgressWithPrefix(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->once()->with("\rProcessing files: 00/10 --------------------   0% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 01/10 ==------------------  10% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 02/10 ====----------------  20% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 03/10 ======--------------  30% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 04/10 ========------------  40% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 05/10 ==========----------  50% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 06/10 ============--------  60% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 07/10 ==============------  70% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 08/10 ================----  80% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 09/10 ==================--  90% ");
		$output->shouldReceive('write')->once()->with("\rProcessing files: 10/10 ==================== 100% ");
		$output->shouldReceive('write')->once()->with(PHP_EOL);

		$progressBar = new ProgressBar($output, 10);

		$progressBar->setPrefix('Processing files:');

		$progressBar->draw();

		for($i = 0; $i < 10; $i++)
		{
			$progressBar->advance();
		}
	}

	/**
	 *
	 */
	public function testProgressWith100ItemsAndDefaultRedrawRate(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->times(102);

		$progressBar = new ProgressBar($output, 100);

		$progressBar->draw();

		for($i = 0; $i < 100; $i++)
		{
			$progressBar->advance();
		}
	}

	/**
	 *
	 */
	public function testProgressWith1000ItemsAndDefaultRedrawRate(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->times(102);

		$progressBar = new ProgressBar($output, 1000);

		$progressBar->draw();

		for($i = 0; $i < 1000; $i++)
		{
			$progressBar->advance();
		}
	}

	/**
	 *
	 */
	public function testProgressWith1000ItemsAndCustomtRedrawRate(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->times(1002);

		$progressBar = new ProgressBar($output, 1000, 1);

		$progressBar->draw();

		for($i = 0; $i < 1000; $i++)
		{
			$progressBar->advance();
		}
	}

	/**
	 *
	 */
	public function testRemoveIncomplete(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->once()->with("\r00/10 --------------------   0% ");

		$output->shouldReceive('clearLines')->once()->with(1);

		$progressBar = new ProgressBar($output, 10);

		$progressBar->draw();

		$progressBar->remove();
	}

	/**
	 *
	 */
	public function testRemoveComplete(): void
	{
		$output = Mockery::mock(Output::class);

		$output->shouldReceive('write')->once()->with("\r00/10 --------------------   0% ");
		$output->shouldReceive('write')->once()->with("\r01/10 ==------------------  10% ");
		$output->shouldReceive('write')->once()->with("\r02/10 ====----------------  20% ");
		$output->shouldReceive('write')->once()->with("\r03/10 ======--------------  30% ");
		$output->shouldReceive('write')->once()->with("\r04/10 ========------------  40% ");
		$output->shouldReceive('write')->once()->with("\r05/10 ==========----------  50% ");
		$output->shouldReceive('write')->once()->with("\r06/10 ============--------  60% ");
		$output->shouldReceive('write')->once()->with("\r07/10 ==============------  70% ");
		$output->shouldReceive('write')->once()->with("\r08/10 ================----  80% ");
		$output->shouldReceive('write')->once()->with("\r09/10 ==================--  90% ");
		$output->shouldReceive('write')->once()->with("\r10/10 ==================== 100% ");
		$output->shouldReceive('write')->once()->with(PHP_EOL);

		$output->shouldReceive('clearLines')->once()->with(2);

		$progressBar = new ProgressBar($output, 10);

		$progressBar->draw();

		for($i = 0; $i < 10; $i++)
		{
			$progressBar->advance();
		}

		$progressBar->remove();
	}
}
