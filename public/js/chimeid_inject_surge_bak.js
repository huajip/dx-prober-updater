var body = $response.body;
body=body+'<script src="https://prober.jinale.com/js/chimeid_inject.js"></script>';
$done({body});
