
<script src="http://d3js.org/d3.v3.min.js"></script>



<div class="row vertBuffer20">
<input type="radio" name="radData" id="rad1" value="data1" checked="checked" onclick='change(data1);' />
<label for="rad1">Data1</label>

<input type="radio" name="radData" id="rad2" value="data2" onclick='change(data2);' />
<label for="rad2">Data2</label>
</br>
<div id='chartDiv'></div>
</div>

<script type="text/javascript">
var data1 = [{
    "crimeType": "mip",
    "totalCrimes": 24
}, {
    "crimeType": "theft",
    "totalCrimes": 558
}, {
    "crimeType": "drugs",
    "totalCrimes": 81
}, {
    "crimeType": "arson",
    "totalCrimes": 3
}, {
    "crimeType": "assault",
    "totalCrimes": 80
}, {
    "crimeType": "burglary",
    "totalCrimes": 49
}, {
    "crimeType": "disorderlyConduct",
    "totalCrimes": 63
}, {
    "crimeType": "mischief",
    "totalCrimes": 189
}, {
    "crimeType": "dui",
    "totalCrimes": 107
}, {
    "crimeType": "resistingArrest",
    "totalCrimes": 11
}, {
    "crimeType": "sexCrimes",
    "totalCrimes": 24
}, {
    "crimeType": "other",
    "totalCrimes": 58
}];


var data2 = [{
    "crimeType": "mip",
    "totalCrimes": 10
}, {
    "crimeType": "theft",
    "totalCrimes": 30
}, {
    "crimeType": "drugs",
    "totalCrimes": 10
}, {
    "crimeType": "arson",
    "totalCrimes": 3
}, {
    "crimeType": "assault",
    "totalCrimes": 80
}, {
    "crimeType": "burglary",
    "totalCrimes": 49
}, {
    "crimeType": "disorderlyConduct",
    "totalCrimes": 10
}, {
    "crimeType": "mischief",
    "totalCrimes": 389
}, {
    "crimeType": "dui",
    "totalCrimes": 507
}, {
    "crimeType": "resistingArrest",
    "totalCrimes": 11
}, {
    "crimeType": "sexCrimes",
    "totalCrimes": 24
}, {
    "crimeType": "other",
    "totalCrimes": 258
}];




var width = 800,
    height = 250,
    radius = Math.min(width, height) / 2;

var color = d3.scale.ordinal()
    .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

var arc = d3.svg.arc()
    .outerRadius(radius - 10)
    .innerRadius(radius - 70);

var pie = d3.layout.pie()
    .sort(null)
    .value(function(d) {
        return d.totalCrimes;
    });


var svg = d3.select("#chartDiv").append("svg")
    .attr("width", width)
    .attr("height", height)
    .append("g")
    .attr("id", "pieChart")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

var path = svg.selectAll("path")
    .data(pie(data1))
    .enter()
    .append("path");

path.transition()
    .duration(500)
    .attr("fill", function(d, i) {
        return color(d.data.crimeType);
    })
    .attr("d", arc)
    .each(function(d) {
        this._current = d;
        console.log(this._current);
    }); // store the initial angles


function change(data) {
    path.data(pie(data));
    path.transition().duration(750).attrTween("d", arcTween); // redraw the arcs

}

// Store the displayed angles in _current.
// Then, interpolate from _current to the new angles.
// During the transition, _current is updated in-place by d3.interpolate.

function arcTween(a) {
    var i = d3.interpolate(this._current, a);
    this._current = i(0);
    return function(t) {
        return arc(i(t));
    };
}
</script>
