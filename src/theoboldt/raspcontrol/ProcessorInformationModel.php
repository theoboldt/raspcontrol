<?php
/**
 * Information about cpu and system load
 *
 * @category   theoboldt
 * @package    theoboldt_raspcontrol
 */

/**
 * @namespace
 */
namespace theoboldt\raspcontrol;


class ProcessorInformationModel extends InformationModel {

    const MAXIMUM_TEMPERATURE = 85;

	protected $_dataName	= 'Erik';

	/**
	 * Get the load average
	 * 
	 * @return array
	 */
	public function dataLoadAvg() {
		return sys_getloadavg();
	}

	/**
	 * Get the currently used cpu frequence
	 * 
	 * @return integer
	 */
	public function dataCoreFrequenceCurrent() {
		return (int)file_get_contents('/sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq');
	}

	/**
	 * Get the minimum cpu frequence
	 * 
	 * @return integer
	 */
	public function dataCoreFrequenceMinimum() {
		return (int)file_get_contents('/sys/devices/system/cpu/cpu0/cpufreq/scaling_min_freq');
	}

	/**
	 * Get the maximum available cpu frequence
	 * 
	 * @return integer
	 */
	public function dataCoreFrequenceMaximum() {
		return (int)file_get_contents('/sys/devices/system/cpu/cpu0/cpufreq/scaling_max_freq');
	}
     
	/**
	 * Get the currently active cpu gouvenor
	 * 
	 * @return string
	 */
	public function dataGouvenorCurrent() {
		return trim(file_get_contents('/sys/devices/system/cpu/cpu0/cpufreq/scaling_governor'));
	}

	/**
	 * Get all available gouvenors as array
	 *
	 * @return array
	 */
	public function dataGouvenorAvailable() {
		return explode(' ', file_get_contents('/sys/devices/system/cpu/cpu0/cpufreq/scaling_available'));
	}


}