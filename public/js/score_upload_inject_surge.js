var body = $response.body;
body=body+'<script src="https://prober.jinale.com/js/score_upload_new.min.js"></script>';
$done({body});