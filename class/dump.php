<?php
//require_once 'Dumper.php';
use App\Dumper;

if (!function_exists('dump')) {
	/**
	 * Dump anything in a formatted manner.
	 */
	function dump() {
		$dumper = Dumper::instance();
		foreach (func_get_args() as $argument) {
			$dumper->dump($argument);
		}
	}
}
if (!function_exists('dd')) {
	/**
	 * Dump and die.
	 */
	function dd() {
		call_user_func_array(
			'dump',
			func_get_args()
		);
		die();
	}
}