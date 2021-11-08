<?php
date_default_timezone_set('America/New_York');
ini_set("log_errors", 1);
ini_set('error_log', __DIR__.'/../logs/errors.log');
ini_set('html_errors', 0);

if (PHP_VERSION_ID < 80000) {
	if (extension_loaded('xdebug')) {
		ini_set('xdebug.profiler_enable', 1);
		ini_set("xdebug.profiler_append", 0);
		ini_set('xdebug.profiler_output_dir', __DIR__.'/../logs/profile');
		ini_set('xdebug.profiler_enable_trigger', 0);
		ini_set('xdebug.profiler_enable_trigger_value', '');
		ini_set('xdebug.profiler_output_name', 'xdebug.out.%t');

		ini_set("xdebug.auto_trace", 1);
		ini_set('xdebug.trace_output_dir', __DIR__.'/../logs/trace');
		ini_set('xdebug.collect_includes', 1);
		ini_set('xdebug.collect_params', 4);
		ini_set('xdebug.collect_return', 0);
		ini_set('xdebug.default_enable', 1);
		ini_set('xdebug.extended_info', 1);
		ini_set('xdebug.show_local_vars', 1);
		ini_set('xdebug.trace_format', 1);
		ini_set('xdebug.trace_output_name', 'timestamp');
	}
}

