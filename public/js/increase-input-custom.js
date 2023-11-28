$(document).ready(function () {
  const plus = document.querySelector(".incremment-plus"),
    minus = document.querySelector(".incremment-minus"),
    num = document.querySelector(".incremment-num"),
    numberInput = document.querySelector('input[name="quantity"]');
  let a = 1;

  plus.addEventListener("click", () => {
    a++;
    numberInput.value = a;
    num.innerText = a;
  });

  minus.addEventListener("click", () => {
    a--;
    if (a < 1) {
      a = 1;
      return;
    }
    numberInput.value = a;
    num.innerText = a;
  });
});



