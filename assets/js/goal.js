var pBar = document.querySelector(".goalContainer  .percentageBar");
var pBarP = document.querySelector(".goalContainer  p");

var goal = document.getElementById('goal');

function animate (time) {
  requestAnimationFrame(animate);
  TWEEN.update(time);
}
var goal = 80;

requestAnimationFrame(animate);
var start = {x: 0};
var tween = new TWEEN.Tween(start)
    .to({x: goal}, 500)
    .onUpdate( function () {
      console.log(goal);
      pBarP.innerHTML = Math.round(start.x) + "%";
      pBar.style.width = start.x + "%";
    })
  .start();
