function startTimer(duration, display) {
  var timer = duration,
    minutes,
    seconds;
  var intervalId = setInterval(function () {
    minutes = parseInt(timer / 60, 10);
    seconds = parseInt(timer % 60, 10);
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    display.textContent = minutes + ":" + seconds;

    if (--timer < 0) {
      clearInterval(intervalId);
      window.location.href = "acabou.php";
    }
  }, 1000);
}

window.onload = function () {
  var duration = 120;
  display = document.querySelector("#timer");
  startTimer(duration, display);
};
