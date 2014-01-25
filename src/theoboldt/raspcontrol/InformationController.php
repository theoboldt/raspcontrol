<?php
/**
 * Controller base
 *
 * @category   theoboldt
 * @package    theoboldt_raspcontrol
 */

/**
 * @namespace
 */
namespace theoboldt\raspcontrol;


class InformationController {


	/**
	 * Contains the appropriate model
	 *
	 * @var	InformationModel
	 */
	protected $_model;

	public function __construct(InformationModel $model = null) {
		if ($model) {
			$this->_model	= $model;
		} else {
			$class	= get_class($this);

			if (preg_match('/^(.*)InformationController$/', $class, $classBase)) {
				$modelClass	=	$classBase[1].'InformationModel';
				
				if(class_exists($modelClass)) {
					$this->_model	= new $modelClass();
				}
			} else {
				throw new \BadMethodCallException('Given controller class name is invalid');
			}
		}
	}

	public function model() {
		return $this->_model;
	}


}