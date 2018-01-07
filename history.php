<script>

/* Request data for every minute */
setInterval(RequestMCSData, 1000);
//var cnt = 0;
function RequestMCSData()
{
  // if(cnt % 2 == 0)
  //   change(dataset);
  // else
  //   change(dataset2);

  // cnt++;

  var xhr = new XMLHttpRequest();
  xhr.open("GET", "https://api.mediatek.com/mcs/v2/devices/D50Vc0GM/datachannels/Test_only/datapoints?limit=1000", true);
  xhr.setRequestHeader("deviceKey", "jur0mgrSH4gJ8KJr")
  xhr.setRequestHeader("Content-Type", "application/json")

  /* Set call back function */
  xhr.onreadystatechange = function(){
      /* If the request is done and the response is successful */
      if(xhr.readyState == 4 && xhr.status == 200) 
      {
          var data = JSON.parse(xhr.response)
          console.log(data.dataChannels[0].dataPoints[0].values.value);

          /* Update the chart */
      }
  }

  xhr.send();
} 

</script>