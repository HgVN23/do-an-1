const formchangepass = document.querySelector(".formchangepass");
formchangepass.addEventListener("submit", function (event) {
  event.preventDefault();
  const inputs = this.querySelectorAll("input[type='password']");
  const checkValue = Array.from(inputs).every((e) => e.value);
  const checkpassnew = inputs[1].value === inputs[2].value;
  const checkpassnewold = inputs[0].value !== inputs[1].value;
  if (checkValue) {
    if (checkpassnew) {
      if (checkpassnewold) {
        const formdata = new FormData(this);
        formdata.append("changebtn", true);
        formdata.append("oldpass", inputs[0].value);
        formdata.append("newpass", inputs[1].value);
        formdata.append("newpassconfirm", inputs[2].value);
        $.ajax({
          type: "post",
          data: formdata,
          url: "../mvc/Application.php",
          processData: false,
          contentType: false,
          success: function (response) {
            const checkoldpass = getCookie("checkoldpass");
            const statechangepass = getCookie("statechangepass");

            if (!checkoldpass) {
              formchangepass.querySelectorAll(".error")[0].innerText =
                "Mật khẩu hiện tại không đúng";
            } else {
              if (statechangepass) {
                $("#modalChangePass").modal("toggle");
                $(".toast").toast("show");
              }
            }
          },
        });
      } else {
        this.querySelectorAll(".error")[1].innerText =
          "Mật khẩu không đặt trùng với mật khẩu cũ";
      }
    } else {
      this.querySelectorAll(".error")[2].innerText =
        "Mật khẩu không khớp với mật khẩu mới";
    }
  } else {
    Array.from(this.querySelectorAll(".error")).forEach((e, index) => {
      !inputs[index].value && (e.innerText = "Chưa nhập mật khẩu");
    });
  }
});

$("#modalChangePass").on("hidden.bs.modal", function (e) {
  const inputs = formchangepass.querySelectorAll("input[type='password']");
  Array.from(inputs).forEach((e) => (e.value = ""));
  Array.from(this.querySelectorAll(".error")).forEach((e, index) => {
    e.innerText = "";
  });
});

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(";").shift();
}

document.addEventListener("DOMContentReady", function () {
  $("#toast").toast();
});

// filter page khoa
// ds giảng viên
const btnfilter = document.querySelector(".btn-filter");

btnfilter.addEventListener("click", function (event) {
  const selects = document.querySelectorAll(".select-filter");
  const formdata = new FormData();
  formdata.append("filter", true);
  selects.forEach((e, index) => {
    const i = index + 1;
    formdata.append("selectValue" + i, e.value);
  });

  $.ajax({
    type: "post",
    data: formdata,
    url: "",
    processData: false,
    contentType: false,
    success: function (response) {
      for (var pair of formdata.entries()) {
        console.log(pair[0] + ", " + pair[1]);
      }
      const bodyRegex = /<body[^>]*>((.|[\n\r])*)<\/body>/im;
      const match = bodyRegex.exec(response);
      const responseBody = match[1];
      const body = document.createElement("div");
      body.innerHTML = responseBody;
      console.log(body);
      const tablebodycontent = body.querySelector("#table-body-content");
      document.getElementById("table-body-content").innerHTML =
        tablebodycontent.innerHTML;
    },
  });
});

const selectElement = document.querySelectorAll("table .select-element");
const tablebody = document.getElementById("table-body-content");
const arrHPGV = {};
selectElement.forEach(function (element, index) {
  // Gán hàm xử lý sự kiện cho sự kiện 'change'
  element.addEventListener("change", function (event) {
    // Lấy giá trị của option đã được chọn
    const selectedOption = event.target.value;

    const rows = tablebody.rows[index];
    const mhp = rows.cells[1].textContent;
    const lop = rows.cells[3].textContent;
  });
});
