const addSizeProductBtn = document.getElementById('addSizeProductBtn');
const addColorProductBtn = document.getElementById('addColorProductBtn');

const addSizeField = document.getElementById('quantitySizeField');
const addColorField = document.getElementById('quantityColorField');

addSizeProductBtn.addEventListener('click', e => {
  const sizesSelected = document.querySelectorAll('.sizeProductItem');
  const sizeProductItem = document.createElement('div');
  sizeProductItem.classList.add('row', 'mb-3', 'sizeProductItem');

  $.ajax({
    method: 'GET',
    url: 'http://mango.local/api/sizes',
    dataType: 'json'
  }).done(function (data) {
    let html = '';
    html += `
      <div class="col-6">
        <label class="form-label">Số lượng:</label>
        <input type="number" class="form-control form-control-lg" min="1" max="9999" name="sizeProduct_${sizesSelected.length + 1}[]" required>
      </div>
      <div class="col-6">
        <label class="form-label">Kích cỡ:</label>
        <select class="form-select form-select-lg" name="sizeProduct_${sizesSelected.length + 1}[]" required>
    `;

    data.forEach(sizeItem => {
      html += '<option value="' + sizeItem.size + '">' + sizeItem.size + '</option>';
    });

    html += '</select> </div>';
    sizeProductItem.innerHTML = html;
    addSizeField.appendChild(sizeProductItem);
  });
});



addColorProductBtn.addEventListener('click', e => {
  const colorsSelected = document.querySelectorAll('.colorProductItem');
  const colorProductItem = document.createElement('div');
  colorProductItem.classList.add('row', 'mb-3', 'colorProductItem');

  $.ajax({
    method: 'GET',
    url: 'http://mango.local/api/colors',
    dataType: 'json'
  }).done(function (data) {
    let html = '';
    html += `
      <div class="col-6">
        <label class="form-label">Số lượng:</label>
        <input type="number" class="form-control form-control-lg" min="1" max="9999" name="colorProduct_${colorsSelected.length + 1}[]" required>
      </div>
      <div class="col-6">
        <label class="form-label">Màu:</label>
        <select class="form-select form-select-lg" name="colorProduct_${colorsSelected.length + 1}[]" required>
    `;

    data.forEach(colorItem => {
      html += '<option value="' + colorItem.color_code + '">' + colorItem.color + '</option>';
    });

    html += '</select> </div>';
    colorProductItem.innerHTML = html;
    addColorField.appendChild(colorProductItem);
  });
});