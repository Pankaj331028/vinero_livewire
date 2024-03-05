<?php

return [
	'property_status' => [
		'NL' => 'New Listing',
		'IP' => 'In Process',
		'RJ' => 'Rejected',
		'AC' => 'Active',
		'FL' => 'Flagged',
		'VC' => 'VMS 24 hour closed',
		'FR' => 'FARM',
		'SO' => 'Sold out',
	],
	'property_status_link' => [
		'NL' => 'primary',
		'IP' => 'warning',
		'RJ' => 'danger',
		'AC' => 'success',
		'FL' => 'warning',
		'VC' => 'warning',
		'FR' => 'warning',
		'SO' => 'success',
	],

	'offer_status' => [
		'PN' => 'Pending',
		'AC' => 'Active',
		'IN' => 'Incomplete',
		'RJ' => 'Declined',
		'CL' => 'Withdrawn',
		'DL' => 'Deleted',
		'SO' => 'Sold out',
		'DCIN' => 'Documents Incomplete',
		'FCIN' => 'FC Incomplete',
		'AP' => 'Approved',
	],
	'doc_status' => [
		'AC' => 'Verified',
		'IN' => 'Incomplete',
	],
	'vmsuser_status' => [
		'0' => 'Inactive',
		'1' => 'Active',
		'3' => 'Blocked',
	],

	'vmsuser_status' => [
		'0' => 'Inactive',
		'1' => 'Active',
	],

	'account_status' => [
		'IN' => 'Inactive',
		'AC' => 'Active',
	],

	'background' => [
		'PN' => 'warning',
		'AC' => 'success',
		'IN' => 'warning',
		'RJ' => 'danger',
		'DL' => 'danger',
		'DCIN' => 'warning',
		'FCIN' => 'warning',
	],
	'status_link' => [
		'AC' => 'Deactivate',
		'IN' => 'Activate',
	],

	//property
	'buyer_credit' => [
		'yes' => 'Yes',
		'no' => 'No',
		'will_consider' => 'Will Consider',
	],

	'allocation' => [
		'buyer' => 'Buyer',
		'seller' => 'Seller',
		'50' => '50/50',
		'pay_own_fee' => 'Pay own fee',
	],

	'occupancy' => [
		'owner' => 'Owner',
		'vacant' => 'Vacant',
		'tenant' => 'Tenant',
	],

	'possession' => [
		'close_escrow' => 'Close of escrow',
		'month_day' => 'Month day',
		'rent_back' => 'Seller rent back',
		'tenant_rights' => "Tenant's Rights",
	],

	'property' => [
		'single_family' => 'Single Family Dwelling',
		'condo' => 'Condo',
		'multiunit' => 'Multiunit',
		'tic' => "TIC",
	],

	'realtor' => [
		'call_with_agent' => 'Call with Agent',
		'decline' => 'Decline',
	],

	'inspection' => [
		'inspection_removal' => 'Inspection Removal',
		'1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
		'7' => '7',
		'8' => '8',
		'9' => '9',
		'10' => '10',
	],

	'entity' => [
		'principal' => 'Principal',
		'llc' => 'LLC',
		'trust' => 'Trust',
		'corporation' => 'Corporation',
		'legal_entity' => 'Legal Entity',
	],

	//items
	'items' => [
		'stove_oven' => 'Stove Oven',
		'refrigerator' => 'Refrigerator',
		'wine_refrigerator' => 'Wine Refrigerator',
		'washer' => 'Washer',
		'dryer' => 'Dryer',
		'dishwasher' => 'Dishwasher',
		'microwave' => 'microwave',
		'video_doorbell' => 'Video Doorbell',
		'security_camera' => 'Security Camera',
		'security_system' => 'Security System',
		'control_devices' => 'Control Devices',
		'audio_equipment' => 'Audio Equipment',
		'ground_pool' => 'Ground Pool',
		'bathroom_mrrors' => 'Bathroom mirror',
		'bathroom_mirrors' => 'Bathroom mirror',
		'car_charging_system' => 'Car Charging System',
		'potted_trees' => 'Potted Trees',
		'additional_items' => 'Additional Items',
		'excluded_items' => 'Excluded Items',
	],
	'status' => [
		'pre_approval' => 'Pre approval',
		'pre_qualification' => 'Pre qualification',
		'all_cash' => 'all_cash',
	],

	'buyer_opt_modes' => [
		'OPTIN' => 'Opt In',
		'OPTOUT' => 'Opt Out',
		'OPTINMODE1' => 'Opt In Mode 1',
		'OPTINMODE2' => 'Opt In Mode 2',
		'OPTOUTMODE1' => 'Opt Out Mode 1',
		'OPTOUTMODE2' => 'Opt Out Mode 2',
	],

	'survey' => [
		'1' => 'Very unsatisfied',
		'2' => 'Unsatisfied',
		'3' => 'Neutral',
		'4' => 'Satisfied',
		'5' => 'Very satisfied',
	],
	'survey_type' => [
		'user_friendly' => 'User friendly',
		'enjoyed_experience' => 'Enjoyed the experience',
		'convenience' => 'Convenience',
		'complicated' => 'Complicated',
		'exiting' => 'Exiting',
		'intrusive' => 'Intrusive',
		'kept_me_informed' => 'Kept me informed',
		'kept_me_control' => 'Kept me in control',
		'kept_me_focused' => 'Kept me focused',
		'found_value' => 'Found value',
		'will_use_it_again' => 'Will use it again',
		'will_recommend' => 'Will recommend',
		'transparency' => 'Transparency',
		'fairness' => 'Fairness',
		'inclusiveness' => 'Inclusiveness',
		'a_better_way' => 'A better way',
		'frictions' => 'Frictions',
	],
	'agreement' => [
		'car' => 'CAR Purchase Agreement',
		'sfar' => 'SFAR Purchase Agreement',
	],

	"modules" => [
		"buyer" => [
			'name' => 'Buyers',
			'actions' => [
				'list', 'edit', 'view', 'block',
			],
		],
		"agent" => [
			'name' => 'Agents',
			'actions' => [
				'list', 'edit', 'view', 'block',
			],
		],
		"seller" => [
			'name' => 'Sellers',
			'actions' => [
				'list', 'edit', 'view', 'block',
			],
		],
		"all_property" => [
			'name' => 'All Properties',
			'actions' => [
				'list', 'edit', 'view',
			],
		],
		"active_property" => [
			'name' => 'Active Properties',
			'actions' => [
				'list', 'edit', 'view',
			],
		],
		"farm_property" => [
			'name' => 'F.A.R.M. Properties',
			'actions' => [
				'list', 'edit', 'view',
			],
		],
		"report" => [
			'name' => 'Reports',
			'actions' => [
				'list', 'view',
			],
		],
		"survey" => [
			'name' => 'Survey',
			'actions' => [
				'list', 'view',
			],
		],
		"notification" => [
			'name' => 'Notifications',
			'actions' => [
				'list', 'view',
			],
		],
	],

];
