window.onload = function () {
  var pBar = document.querySelector(".goalContainer  .percentageBar");
  var pBarP = document.querySelector(".goalContainer > p");

  var goal = document.getElementById('goal').dataset.percentage;

  function animate (time) {
    requestAnimationFrame(animate);
    TWEEN.update(time);
  }

  requestAnimationFrame(animate);
  var start = {x: 0};
  var tween = new TWEEN.Tween(start)
      .to({x: goal}, 500)
      .onUpdate( function () {
        pBarP.innerHTML = Math.round(start.x) + "%";
        pBar.style.width = start.x + "%";
      })
    .start();
};
