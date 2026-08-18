<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| Job workflow (docs/WORKFLOW.md). Status integers match claims_livelocationjob.status.
| Seats match claims_connect_with_department.usertype.
*/

$config['workflow_seats'] = array(
    '1' => 'individual',
    '2' => 'surveyor_admin',
    '3' => 'handler',
    '4' => 'accounts',
);

/** REG requires ILA+LOR; STY skips those. Both require media. See R-29. */
$config['workflow_assignment_classes'] = array(
    'REG' => array(
        'label' => 'Regular',
        'requires_media' => true,
        'requires_ila' => true,
        'requires_lor' => true,
    ),
    'STY' => array(
        'label' => 'Stereotype',
        'requires_media' => true,
        'requires_ila' => false,
        'requires_lor' => false,
    ),
);

$config['workflow_statuses'] = array(
    1 => array(
        'code' => 'under_survey',
        'label' => 'Under Survey',
        'bootstrap' => 'info',
        'stage' => 'W-04',
        'search_aliases' => array(),
    ),
    2 => array(
        'code' => 'ila_media',
        'label' => 'Photo Uploaded',
        'bootstrap' => 'success',
        'stage' => 'W-05',
        'search_aliases' => array('Photo Upload', 'ILA + Photo'),
        'assignment_class' => 'REG',
    ),
    3 => array(
        'code' => 'lor',
        'label' => 'LOR Sent',
        'bootstrap' => 'success',
        'stage' => 'W-06',
        'search_aliases' => array(),
        'assignment_class' => 'REG',
    ),
    4 => array(
        'code' => 'fsr',
        'label' => 'FSR',
        'bootstrap' => 'success',
        'stage' => 'W-07',
        'search_aliases' => array(),
    ),
    5 => array(
        'code' => 'billing',
        'label' => 'Billing',
        'bootstrap' => 'success',
        'stage' => 'W-08',
        'search_aliases' => array('Bill Generated'),
    ),
    6 => array(
        'code' => 'waiting_ti',
        'label' => 'Waiting for TI',
        'bootstrap' => 'warning',
        'stage' => 'W-09',
        'search_aliases' => array(),
    ),
    7 => array(
        'code' => 'pending_dispatch',
        'label' => 'Pending for Dispatch',
        'bootstrap' => 'warning',
        'stage' => 'W-09',
        'search_aliases' => array(),
    ),
    8 => array(
        'code' => 'dispatched',
        'label' => 'Dispatched',
        'bootstrap' => 'success',
        'stage' => 'W-10',
        'search_aliases' => array(),
    ),
    9 => array(
        'code' => 'partial_payment',
        'label' => 'Partially Payment Received',
        'bootstrap' => 'warning',
        'stage' => 'W-11',
        'search_aliases' => array(),
    ),
    10 => array(
        'code' => 'complete',
        'label' => 'Case Completed',
        'bootstrap' => 'success',
        'stage' => 'W-12',
        'search_aliases' => array(),
    ),
    11 => array(
        'code' => 'cancelled',
        'label' => 'Cancelled',
        'bootstrap' => 'danger',
        'stage' => 'W-12',
        'search_aliases' => array(),
    ),
);

/** Statuses accounts people work from (W-08 onward). */
$config['workflow_accounts_statuses'] = array(5, 6, 7, 8, 9, 10);
