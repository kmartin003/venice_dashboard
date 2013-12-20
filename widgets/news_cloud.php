<script src="https://cdn.firebase.com/v0/firebase.js"></script>

<script src="../d3-cloud/lib/d3/d3.js"></script>
<script src="../d3-cloud/d3.layout.cloud.js"></script>
<script>
var dataRef = new Firebase('https://vpc.firebaseio.com/dashboard/newsTags');
  dataRef.on('value', function(snapshot) {
    var js_tags = JSON.parse(snapshot.val());

  var fill = d3.scale.category20();

  d3.layout.cloud().size([180, 150])
      .words(js_tags.map(function(d) {
        return {text: d, size: 10 + Math.random() * 20};
      }))
      .padding(1)
      .rotate(function() { return 0; })
      .font("Impact")
      .fontSize(function(d) { return d.size; })
      .on("end", draw)
      .start();

  function draw(words) {
    d3.select("body").append("svg")
        .attr("width", 180)
        .attr("height", 150)
      .append("g")
        .attr("transform", "translate(85,75)")
      .selectAll("text")
        .data(words)
      .enter().append("text")
        .style("font-size", function(d) { return d.size + "px"; })
        .style("font-family", "Helvetica Neue")
        .style("fill", function(d, i) { return 0; })
        .attr("text-anchor", "middle")
        .attr("transform", function(d) {
          return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
        })
        .text(function(d) { return d.text; });
  }
  });

</script>
