// const fileInputEl = document.getElementById('formFile');

// function removeFileFromFileList(fileName) {
//   const dt = new DataTransfer();
//   const input = document.getElementById('fileInputEl');
//   const { files } = input;

//   for (let i = 0; i < files.length; i++) {
//     const file = files[i];
//     if (fileName !== file.name)
//       dt.items.add(file); // thêm những file khác file truyền vào
//   }

//   input.files = dt.files; // Cập nhật file list
// }

function deleteIllustration(illustration_path) {
  const frmDelete = document.forms['frmDeleteIllustration'];
  frmDelete.action = '/admin/delete-illustration/' + illustration_path;
  frmDelete.submit();
}

