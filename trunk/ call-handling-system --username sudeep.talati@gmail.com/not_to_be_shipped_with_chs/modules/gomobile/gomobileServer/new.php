
<button onclick="proto_test();">Test Button</button>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

function proto_test() 
{
var data = {};
data['abc'] = [];
data['abc'].push('some info');
data['abc'].push('some more info');
json_data = JSON.stringify(data);
console.log(json_data);
$.post("http://127.0.0.1/purva/gomobileServer/proto2.php", {'jsonData': json_data},function(data) {alert(data);});
//$.post("proto2.php", {'jsonData': json_data},function(data) {alert(data);});

}

</script>
