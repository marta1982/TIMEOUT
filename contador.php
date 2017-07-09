<?php
/**
 * *  * Implements hook_block_info().
 * *   
 */
function timeout_block_info() {
	$blocks = array();
	$blocks['timeout'] = array(
		'info' => t('Timeout'),
		);

	return $blocks;
}

function timeout_block_view($delta = '') {

	$node = menu_get_object();
    dsm($node);
	$entity_id = $node->nid;
	$entity_type = 'node';

	$settings = registration_entity_settings($entity_type, $entity_id, $reset);
	$open = isset($settings['open']) ? strtotime($settings['open']) : NULL;
	$close = isset($settings['close']) ? strtotime($settings['close']) : NULL;
	$now = REQUEST_TIME;

	if (isset($close)) {

		$diff=$close-time();
		$days=floor($diff/(60*60*24));
		$hours=round(($diff-$days*60*60*24)/(60*60));

		$block['content'] = "Quedan $days días $hours horas al cierre de las inscripciones";
	}

	return $block;
}
