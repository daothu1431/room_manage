let toast = document.querySelector('#MessageFlash');
toast.style.opacity = 'block';
setTimeout(function() {
    toast.style.display = 'none';
}, 3000);

// Thêm
var modal = document.getElementById("myModal");
var btn = document.getElementById("openModalBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}


// Sửa
const modalEdit = document.getElementById("myModalEdit");
const btnEdit = document.getElementById("openModalBtnEdit");
const spanEdit = document.getElementsByClassName("closeEdit")[0]; // Sửa chỉ số index thành 0

// Mở modal khi nút được click
btnEdit.onclick = function(event) {
  modalEdit.style.display = "block";
  event.stopPropagation(); // Ngăn chặn lan truyền sự kiện
}

// Đóng modal khi nút đóng được click
spanEdit.onclick = function(event) {
  modalEdit.style.display = "none";
  event.stopPropagation(); // Ngăn chặn lan truyền sự kiện
}


function updateTienPhong() {
  const roomSelect = document.getElementById('room_id');
  const selectedOption = roomSelect.options[roomSelect.selectedIndex];
  const giaPhong = selectedOption.getAttribute('data-giaphong');
  
  // document.getElementById('tienphong').value = giaPhong;

  // Định dạng số tiền với dấu phân cách hàng nghìn
  var formattedTienPhong = numberWithCommas(giaPhong);

  // Cập nhật giá trị của trường input tiền phòng
  document.getElementById('tienphong').value = formattedTienPhong + ' VND';
}

function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function updateChuky() {
  const roomSelect = document.getElementById('room_id');
  const selectedOption = roomSelect.options[roomSelect.selectedIndex];
  const giaPhong = selectedOption.getAttribute('data-chuky');
  
  document.getElementById('chuky').value = giaPhong;
}



function updateSoluong() {
  const roomSelect = document.getElementById('room_id');
  const selectedOption = roomSelect.options[roomSelect.selectedIndex];
  const giaPhong = selectedOption.getAttribute('data-soluong');
  
  document.getElementById('soluongNguoi').value = giaPhong;
}



// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
