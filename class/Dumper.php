<?php

class Dumper
{
	/**
	 * The Dumper instance.
	 * @var Dumper
	 */
	protected static $instance;
	/**
	 * Tracks the usage count of the Dumper.
	 * @var int
	 */
	private $usage = 0;
	/**
	 * Contains the patterns to be replaced
	 * with <span></span> tags.
	 * @var array
	 */
	protected $patterns = [
		'empty' => [
			'/(?<=\(0\)\s\{)\n()\s*?(?=\})/'
		],
		'null' => [
			'/(?:^|\s{2,})(NULL)(?=\n\s*\}|\n\s*\[|$)/'
		],
		'boolean' => [
			'/(?:^|\s{2,})bool\((true|false)\)(?=\n\s*\}|\n\s*\[|$)/'
		],
		'integer' => [
			'/(?:^|\s{2,})int\((0|[1-9]\d*)\)(?=\n\s*\}|\n\s*\[|$)/'
		],
		'float' => [
			'/(?:^|\s{2,})float\(((?:0|[1-9]\d*).?\d*)\)(?=\n\s*\}|\n\s*\[|$)/'
		],
		'string' => [
			'/(?:^|\s{2,})(?:string\(\d+\)\s)("(?:.|\n)*?")(?=\n\s*\}|\n\s*\[|$)/'
		],
		'object' => [
			'/(?:^|\s{2,})object\((([\w_]+?)(?:\\\[\w_]*)*)\)#\d+?\s\(\d+?\)(?=\s\{)/i'
		],
		'array' => [
			'/(?:^|\s{2,})(array)\(\d+?\)(?=\s\{)/'
		],
		'arrow' => [
			'/(?<=\])(\=\>)(?=\<)/'
		],
		'primary' => [
			'/\[(\d+?)\]/'
		],
		'public' => [
			'/\["([\$\w_-]+?)"\]/'
		],
		'protected' => [
			'/\["([\w_-]+?)"(?:\:"([\w_]+)(\\\[\w_]+)*")*:protected\]/'
		],
		'private' => [
			'/\["([\w_-]+?)"(?:\:"([\w_]+)(\\\[\w_]+)*")*:private\]/'
		]
	];
	/**
	 * Dumper constructor.
	 * Should not be called.
	 */
	private function __construct()
	{
	}
	/**
	 * Dump anything in a formatted manner.
	 *
	 * @param mixed $argument The argument to dump.
	 *
	 * @return void
	 */
	public function dump($argument)
	{
		if (!$this->usage) {
			echo '<style type="text/css">';
			echo file_get_contents(
				__DIR__ . '/dump.css'
			);
			echo '</style>';
		}
		echo '<pre class="dump">';
		ob_start();
		var_dump($argument);
		echo $this->format(
			ob_get_clean()
		);
		echo '</pre>';
		$this->usage += 1;
	}
	/**
	 * Format the row output of a PHP
	 * var_dump call.
	 *
	 * @param $dump
	 *
	 * @return mixed
	 */
	protected function format($dump)
	{
		foreach ($this->patterns as $class => $patterns) {
			foreach ($patterns as $pattern) {
				$dump = preg_replace_callback($pattern, function ($matches) use ($class) {
					return "<span class=\"$class\">" . $matches[1] . '</span>';
				}, $dump);
			}
		}
		return $dump;
	}
	/**
	 * Get the single instance of the Dumper.
	 * @return Dumper
	 */
	public static function instance()
	{
		if (!static::$instance instanceof static) {
			static::$instance = new static();
		}
		return static::$instance;
	}
}