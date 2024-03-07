document
  .getElementById("form-createproduct")
  .addEventListener("submit", function (event) {
    var name = document.querySelector("input[name='name']").value;
    var description = document.querySelector("input[name='description']").value;
    var price = document.querySelector("input[name='price']").value;

    var isCheck = true;

    if (name == "") {
      document.getElementById("name-error").innerText =
        "Vui long nhap ten san pham";
      isCheck = false;
    }

    if (!isCheck) {
      alert("Vui lòng nhập tất cả các trường.");
      event.preventDefault(); // Ngăn chặn form được gửi nếu kiểm tra thất bại
    }
  });
