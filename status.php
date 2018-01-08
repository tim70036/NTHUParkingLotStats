<!-- Layout for 4 chart -->
<div class="row">
  <div class="col-md-4" id="area1"></div>
  <div class="col-md-4" id="area2"></div>
</div>

<div class="row">
  <div class="col-md-4" id="area3"></div>
  <div class="col-md-4" id="area4"></div>
</div>

<div class="row">
  <input type="radio" name="radData" id="rad1" onclick="change();">
</div>


<style>
    .arc text {
      font: 10px sans-serif;
      text-anchor: middle;
    }

    .arc path {
      stroke: #fff;
    }

    /* Setting for text on the chart */
    .toolTip {
        position: absolute;
        display: none;
        width: auto;
        height: auto;
        background: none repeat scroll 0 0 white;
        border: 0 none;
        border-radius: 8px 8px 8px 8px;
        box-shadow: -3px 3px 15px #888888;
        color: black;
        font: 12px sans-serif;
        padding: 5px;
        text-align: center;
    }
</style>

<script>

/* The text on the chart */
//var div = d3.select("body").append("div").attr("class", "toolTip");

/* Var setup */
var x = 0;
var gArr = [];
var maxChart = 2;
var maxBlock = 200;

var dataset = [
	{ name: 'bike', total: 0 },
	{ name: 'empty', total: 200  }
];

var y = 500;
var dataset2 = [
  { name: 'bike', total: 0 },
  { name: 'empty', total: 200},
];

// var dataset3 = [
//   { name: 'bike', total: x,  },
//   { name: 'empty', total: maxBlock - x , percent: 13.1 },
// ];

// var dataset4 = [
//   { name: 'bike', total: x, percent: 67.9 },
//   { name: 'empty', total: maxBlock - x , percent: 13.1 },
// ];

/* Set up */
var width = 480,
    height = 250,
    radius = Math.min(width, height) / 2;

/* Color for chart, first data use first color and so on */
var color = d3.scale.ordinal()
    .range(["#ff4d4d", "#ffe6e6", "#7b6888", "#6b486b", "#a05d56"]); 

var arc = d3.svg.arc()
                .outerRadius(radius - 10)
                .innerRadius(radius - 70);

var pie = d3.layout.pie()
                    .sort(null)
                    .startAngle(1.1*Math.PI)
                    .endAngle(3.1*Math.PI)
                    .value(function(d) { return d.total; });

/* Add element */
var chart1 = d3.select("#area1").append("svg")
                .attr("width", width)
                .attr("height", height)
                .append("g")
                .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

gArr[0] = chart1.selectAll(".arc")
              .data(pie(dataset))
              .enter().append("g")
              .attr("class", "arc"); /* setting all of g in chart1 to class arc */

/* Add element */
var chart2 = d3.select("#area2").append("svg")
                .attr("width", width)
                .attr("height", height)
                .append("g")
                .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

gArr[1] = chart2.selectAll(".arc")
              .data(pie(dataset2))
              .enter().append("g")
              .attr("class", "arc"); /* setting all of g in chart1 to class arc */

SetUpChart(gArr[0]);
SetUpChart(gArr[1]);

console.log(gArr);

function SetUpChart(tar)
{
  /* Color of chart for different data */
  tar.append("path") // every g has a path
   .style("fill", function(d) { return color(d.data.name); })
   .transition().delay(function(d,i) {return i * 500; })
   .duration(1500)
   .attrTween('d', function(d) 
     {
       var i = d3.interpolate(d.startAngle+0.1, d.endAngle);
       return function(t) 
       {
          d.endAngle = i(t); 
          return arc(d)
       }
    })
   .each(function(d) { this._current = d;}); // store the initial angles 

  tar.append("text")
       .attr("text-anchor", "middle")
       .style("font-size", "3em")
       .attr('y', 15)
       .text(maxBlock);
}

// /* Color of chart for different data */
// g.append("path") // every g has a path
//  .style("fill", function(d) { return color(d.data.name); })
//  .transition().delay(function(d,i) {return i * 500; })
//  .duration(1500)
//  .attrTween('d', function(d) 
//    {
//      var i = d3.interpolate(d.startAngle+0.1, d.endAngle);
//      return function(t) 
//      {
//  	      d.endAngle = i(t); 
//  		    return arc(d)
//   	 }
// 	})
//  .each(function(d) { this._current = d;}); // store the initial angles 

// g.append("text")
//      .attr("text-anchor", "middle")
//      .style("font-size", "3em")
//      .attr('y', 15)
//      .text(x);

/* Text on chart */
// g.append("text")
//     .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
//     .attr("dy", ".35em")
//   .transition()
//   .delay(1500)
//     .text(function(d) { return d.data.name; });




// /* Color of chart for different data */
// g2.append("path")
//  .style("fill", function(d) { return color(d.data.name); })
//  .transition().delay(function(d,i) {return i * 500; })
//  .duration(1500)
//  .attrTween('d', function(d) 
//    {
//      var i = d3.interpolate(d.startAngle+0.1, d.endAngle);
//      return function(t) 
//      {
//         d.endAngle = i(t); 
//         return arc(d)
//      }
//   })
//  .each(function(d) { this._current = d;}); // store the initial angles ; 

// g2.append("text")
//      .attr("text-anchor", "middle")
//      .style("font-size", "3em")
//      .attr('y', 15)
//      .text(x);




// /* Add element */
// var chart3 = d3.select("#area3").append("svg")
//                 .attr("width", width)
//                 .attr("height", height)
//                 .append("g")
//                 .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

// var g3 = chart3.selectAll(".arc")
//               .data(pie(dataset3))
//               .enter().append("g")
//               .attr("class", "arc"); /* setting all of g in chart1 to class arc */
// /* Color of chart for different data */
// g3.append("path")
//  .style("fill", function(d) { return color(d.data.name); })
//  .transition().delay(function(d,i) {return i * 500; })
//  .duration(1500)
//  .attrTween('d', function(d) 
//    {
//      var i = d3.interpolate(d.startAngle+0.1, d.endAngle);
//      return function(t) 
//      {
//         d.endAngle = i(t); 
//         return arc(d)
//      }
//   }); 


// /* Add element */
// var chart4 = d3.select("#area4").append("svg")
//                 .attr("width", width)
//                 .attr("height", height)
//                 .append("g")
//                 .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

// var g4 = chart4.selectAll(".arc")
//               .data(pie(dataset4))
//               .enter().append("g")
//               .attr("class", "arc"); /* setting all of g in chart1 to class arc */
// /* Color of chart for different data */
// g4.append("path")
//  .style("fill", function(d) { return color(d.data.name); })
//  .transition().delay(function(d,i) {return i * 500; })
//  .duration(1500)
//  .attrTween('d', function(d) 
//    {
//      var i = d3.interpolate(d.startAngle+0.1, d.endAngle);
//      return function(t) 
//      {
//         d.endAngle = i(t); 
//         return arc(d)
//      }
//   }); 



	// d3.selectAll("path").on("mousemove", function(d) {
	//     div.style("left", d3.event.pageX+10+"px");
	// 	  div.style("top", d3.event.pageY-25+"px");
	// 	  div.style("display", "inline-block");
    //div.html((d.data.name)+"<br>"+(d.data.total) + "<br>"+(d.data.percent) + "%");
// });
	  
// d3.selectAll("path").on("mouseout", function(d){
//     div.style("display", "none");
// });
	  
	  
//d3.select("body").transition().style("background-color", "#d3d3d3");
function type(d) {
  d.total = +d.total;
  return d;
}

</script>



<script>
var urls = ["https://api.mediatek.com/mcs/v2/devices/D50Vc0GM/datachannels/Test_only/datapoints",
           "https://api.mediatek.com/mcs/v2/devices/D50Vc0GM/datachannels/Test_only/datapoints"];
var devKey = ["jur0mgrSH4gJ8KJr",
              "jur0mgrSH4gJ8KJr"];
/* AJAX set up */
var cnt = [0,0];
var inc = [1,2];
var xhrArr = [];
var CallBack = function(index){
  return function(){
    if(xhrArr[index].readyState == 4 && xhrArr[index].status == 200) 
      {
          var dataPoint = JSON.parse(xhrArr[index].response).dataChannels[0].dataPoints[0].values.value
          console.log(dataPoint);

          /* Update the chart */
          dataPoint += cnt[index];
          cnt[index] += inc[index];
          var newData =  [ { name: 'bike', total: dataPoint }, { name: 'empty', total: maxBlock - dataPoint  }];
          change(newData, gArr[index]);
      }
  }
}

/* Request data for every minute */
setInterval(RequestMCSData, 3000);
function RequestMCSData()
{
    for(var i=0; i<maxChart; i++) 
    {
      xhrArr[i]=new XMLHttpRequest();
      xhrArr[i].open("GET", urls[i], true);
      xhrArr[i].setRequestHeader("deviceKey", devKey[i]);
      xhrArr[i].setRequestHeader("Content-Type", "application/json");
      xhrArr[i].onreadystatechange=CallBack(i);
      xhrArr[i].send();
    }
} 

/* Updating chart */
function change(data, tar) {
    /* Update chart, select the path in this g */
    tar.select("path") 
    .data(pie(data))
    .transition().duration(750).attrTween("d", arcTween); // redraw the arcs

    /* Show the number of empty block, with a little delay */
    tar.select("text")
    .transition()
    .delay(500)
    .text(data[1].total) // empty number

}

function arcTween(a) {
    //console.log(this._current); // undefine
    var i = d3.interpolate(this._current, a);
    this._current = i(0);
    return function(t) {
        return arc(i(t));
    };
}

</script>