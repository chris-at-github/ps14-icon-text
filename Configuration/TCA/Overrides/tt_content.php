<?php

// ---------------------------------------------------------------------------------------------------------------------
// Modul in TYPO3 tt_content registrieren
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:ps14_icon_text/Resources/Private/Language/locallang_tca.xlf:title',
		'ps14_icon_text',
		'ps14-module-icon-text'
	),
	'CType',
	'ps14_icon_text'
);

// ---------------------------------------------------------------------------------------------------------------------
// Modul TCA anpassen

// Felddefinitionen
$GLOBALS['TCA']['tt_content']['types']['ps14_icon_text']['showitem'] = \Ps14\Site\Service\TcaService::getShowitem(
	['general', 'appearance', 'language', 'access', 'categories', 'notes', 'extended'],
	[
		'general' => '--palette--;;general, --palette--;;headers, --palette--;;foundation_identifier, bodytext, tx_foundation_elements,'
	]
);

// Bodytext mit CKEditor rendern
$GLOBALS['TCA']['tt_content']['types']['ps14_icon_text']['columnsOverrides']['bodytext']['config'] = [
	'enableRichtext' => true,
	'richtextConfiguration' => 'ps14Default',
];

// ---------------------------------------------------------------------------------------------------------------------
// Elements TCA anpassen

// Definition Record
$GLOBALS['TCA']['tt_content']['types']['ps14_icon_text']['columnsOverrides']['tx_foundation_elements']['config']['overrideChildTca'] = [
	'columns' => [
		'record_type' => [
			'config' => [
				'items' => [
					[
						'label' => 'LLL:EXT:ps14_icon_text/Resources/Private/Language/locallang_tca.xlf:elements.record-type.default',
						'value' => 'ps14_icon_text_default'
					],
				],
				'default' => 'ps14_icon_text_default'
			]
		],
		'description' => [
			'config' => [
				'richtextConfiguration' => 'ps14Minimal'
			]
		]
	],
	'types' => [
		'ps14_icon_text_default' => [
			'showitem' => \Ps14\Site\Service\TcaService::getShowitem(
				['general', 'appearance', 'access'],
				[
					'general' => '--palette--;;general, --palette--;;header, description, media,'
				],
				'tx_foundation_domain_model_elements'
			)
		],
	]
];

//// Anpassung Crop-Varianten fuer Elements
//$GLOBALS['TCA']['tt_content']['types']['ps14_icon_text']['columnsOverrides']['tx_foundation_elements']['config']['overrideChildTca']['columns']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = \Ps14\Site\Service\TcaService::getCropVariants(
//	[
//		'default' => [
//			'allowedAspectRatios' => ['16_9'],
//			'selectedRatio' => '16_9'
//		],
//	]
//);