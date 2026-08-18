<?php
/**
 * Parser unit checks (no DB). Run: php tests/test_lor_parse.php
 */
define('BASEPATH', true);
require __DIR__ . '/../application/helpers/lor_helper.php';

$fail = 0;
function expect($ok, $msg) {
    global $fail;
    if ($ok) {
        echo "OK  $msg\n";
    } else {
        echo "FAIL $msg\n";
        $fail++;
    }
}

$parsed = lor_parse_appointment_mail(
    "Subject: Motor OD MH-12-AB-1234 appointment\n" .
    "To: Jane Insurer <jane@insurer.com>, claims@broker.com\n" .
    "Cc: desk@office.com\n" .
    "Bcc: handler@surveyor.com\n" .
    "Please attend the survey.\n"
);

expect($parsed['subject'] === 'Motor OD MH-12-AB-1234 appointment', 'subject from header');
expect(count($parsed['parties']) === 4, 'four people');
$by = array();
foreach ($parsed['parties'] as $p) {
    $by[$p['email']] = $p;
}
expect($by['jane@insurer.com']['send_as'] === 'to', 'named To');
expect($by['claims@broker.com']['send_as'] === 'to', 'bare To');
expect($by['desk@office.com']['send_as'] === 'cc', 'Cc');
expect($by['handler@surveyor.com']['send_as'] === 'bcc', 'Bcc');

$subj = lor_compose_subject('Motor OD MH-12-AB-1234 appointment', 'VP/M/25/01/001');
expect($subj === 'Motor OD MH-12-AB-1234 appointment / Our Ref: VP/M/25/01/001', 'compose subject + ref');
$again = lor_compose_subject($subj, 'VP/M/25/01/001');
expect($again === $subj, 'do not duplicate ref');

$lor = array(
    array('id' => 1, 'description' => 'RC', 'received' => false),
    array('id' => 2, 'description' => 'DL', 'received' => true),
);
expect(lor_pending_descriptions($lor) === array('RC'), 'pending only');
expect(lor_next_due_date(7, '2026-08-18') === '2026-08-25', 'frequency +7');

if ($fail) {
    echo "\n$fail failed\n";
    exit(1);
}
echo "\nall passed\n";
exit(0);
