$(document).ready(function () {
  quantity = [];
  $('input[class="quantity"]').each(function (i) {
    quantity[i] = $(this).val() ?? 1;
  });

  $('.incremment-plus').each(function (i, element) {
    $(element).on('click', function () {
      quantity[i]++;
      $('input[class="quantity"]')[i].setAttribute('value', quantity[i]);
      $('.incremment-num')[i].textContent = quantity[i];
    });
  });

  $('.incremment-minus').each(function (i, element) {
    $(element).on('click', function () {
      quantity[i]--;
      if (quantity[i] < 1) {
        quantity[i] = 1;
        return;
      }
      $('input[class="quantity"]')[i].value = quantity[i];
      $('.incremment-num')[i].textContent = quantity[i];
    });
  });
});



