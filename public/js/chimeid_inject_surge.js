var body = $response.body;
body=body+"<script>var ft,et,it=()=>{var nt=Math.floor(new Date().getTime()/1000);if(et<nt){ft.innerText='二维码已过期!'}else{ft.innerText='有效期限 : 剩余'+((et-nt>60)?(Math.floor((et-nt)/60)+'分'):(''))+((et-nt)%60)+'秒';setTimeout(it,1000)}};window.onload=()=>{ft=document.getElementsByClassName('footer')[0];for(var value of window.location.search.replace('?','').split('&')){if(value.indexOf('l=')!=-1){et=value.replace('l=','')-0}}it()}</script>";
$done({body});
