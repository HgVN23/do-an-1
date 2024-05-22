const formchangepass = document.querySelector(".formchangepass");
formchangepass &&
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
                  setTimeout(() => {
                    handelToasts();
                    $(".toast").toast("show");
                  }, 500);
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

document.addEventListener("DOMContentReady", function () {
  $("#toast").toast();
});

window.addEventListener("load", function () {
  const tablebody = document.getElementById("table-body-content");
  if (tablebody.textContent.trim() !== "") {
    const btnfilter = document.querySelector(".btn-filter");
    btnfilter && btnfilter.click();
  }
});

handelformFilter();

function handelformFilter() {
  let filterClicked = false;
  const tablebody = document.getElementById("table-body-content");
  const btnfilter = document.querySelector(".btn-filter");
  btnfilter &&
    btnfilter.addEventListener("click", function (event) {
      const selects = document.querySelectorAll(".select-filter");
      const formdata = new FormData();
      formdata.append("filter", true);
      selects.forEach((e, index) => {
        const i = index + 1;
        formdata.append("selectValue" + i, e.value);
      });

      const checkselect = Array.from(selects).every(
        (e) => e.selectedIndex != 0
      );

      if (checkselect) {
        $.ajax({
          type: "post",
          data: formdata,
          url: "",
          processData: false,
          contentType: false,
          success: function (response) {
            // for (var pair of formdata.entries()) {
            //   console.log(pair[0] + ", " + pair[1]);
            // }

            const bodyRegex = /<body[^>]*>((.|[\n\r])*)<\/body>/im;
            const match = bodyRegex.exec(response);
            const responseBody = match[1];
            // const tablebody = document.getElementById("table-body-content");
            const body = document.createElement("div");
            body.innerHTML = responseBody;
            const tablebodycontent = body.querySelector("#table-body-content");

            if (tablebodycontent) {
              tablebody.innerHTML = tablebodycontent.innerHTML;
              handelformupdate();
              handelformDelete();
              handelformselect();
              if (!filterClicked) {
                handleBtnUpdateTBQT();
                filterClicked = true;
              }
            }
          },
        });
      } else {
        tablebody.innerHTML = "";
      }
    });
}
// filter page khoa
// ds giảng viên

function handelformselect() {
  const tablebody = document.getElementById("table-body-content");
  const selectElement = tablebody.querySelectorAll("table .select-element");
  const arrHPGV = {};
  selectElement &&
    selectElement.forEach(function (element, index) {
      // Gán hàm xử lý sự kiện cho sự kiện 'change'
      element.addEventListener("change", function (event) {
        // Lấy giá trị của option đã được chọn
        const selectedOption = event.target.value;

        const rows = tablebody.rows[index];
        const mhp = rows.cells[1].textContent;
        const malhp = rows.cells[3].getAttribute("data-malhp");
        arrHPGV[index] = [mhp, malhp, selectedOption];
        // console.log(arrHPGV);
      });
    });

  const btnSave = document.querySelector(".btn-save");
  btnSave &&
    btnSave.addEventListener("click", function () {
      const formdata = new FormData();
      formdata.append("save", true);
      formdata.append("data", JSON.stringify(arrHPGV));
      $.ajax({
        type: "post",
        data: formdata,
        url: "../mvc/Application.php",
        processData: false,
        contentType: false,
        success: function (response) {},
      });
    });
}

// update form

function handelformupdate() {
  const btnEdits = document.querySelectorAll(".btn-edit");
  btnEdits &&
    btnEdits.forEach((btn, index) => {
      btn.addEventListener("click", function (event) {
        $("#modaledit").modal("show");
        const arrValues = [];
        const tablebody = document.getElementById("table-body-content");
        const rows = tablebody.rows[index];
        Array.from(rows.cells).forEach((cell) => {
          if (
            !cell.getAttribute("data-hide") &&
            cell.getAttribute("data-show")
          ) {
            arrValues.push(cell.textContent);
          }
        });

        const inputsModal = document
          .querySelector(".formbody")
          .querySelectorAll("input.ipvl");

        inputsModal.forEach((e, i) => {
          if (e.type === "date") {
            e.value = convertDateString(arrValues[i]);
          } else {
            e.value = arrValues[i];
          }
        });

        changeInfoRowTable(rows);
      });
    });
}

function changeInfoRowTable(rows) {
  const btnUpdate = document.querySelector(".btn-update");
  btnUpdate &&
    btnUpdate.addEventListener("click", function (event) {
      event.preventDefault();
      const arrValues = [];
      const inputsModal = document
        .querySelector(".formbody")
        .querySelectorAll("input.ipvl");

      inputsModal.forEach((e, i) => {
        arrValues.push(e.value);
      });

      // page gv
      const mhp = $(".form-select-mon").find(":selected").val() ?? null;
      const mlhp = $(".form-select-lophoc").find(":selected").val() ?? null;

      const formData = new FormData();
      formData.append("updateInfo", true);
      formData.append("values", JSON.stringify(arrValues));

      if (mhp && mlhp) {
        formData.append("mahocphan", mhp);
        formData.append("malophocphan", mlhp);
      }
      $.ajax({
        type: "post",
        data: formData,
        url: "../mvc/Application.php",
        processData: false,
        contentType: false,
        success: function (response) {
          // for (var pair of formData.entries()) {
          //   console.log(pair[0] + ", " + pair[1]);
          // }

          $("#modaledit").modal("hide");
          Array.from(rows.cells).forEach((cell) => {
            if (
              !cell.getAttribute("data-hide") &&
              cell.getAttribute("data-show")
            ) {
              var value = arrValues.shift();
              value = convertDateStringRowTb(value);
              cell.textContent = value;
            }
            if (cell.hasAttribute("data-drl")) {
              // console.log(cell.getAttribute("data-drl"));
              const drl = decodeURIComponent(getCookie("xeploai"));
              cell.textContent = drl;
            }
            if (cell.hasAttribute("data-statethi")) {
              const dcc = rows.querySelector(`td[dt-dcc]`).textContent;
              const htmlstatethi =
                dcc > 6
                  ? `<i class="text-success bi bi-check-circle-fill"></i>`
                  : `<i class="text-danger bi bi-x-circle-fill"></i>`;
              cell.querySelector(".state-icon").innerHTML = htmlstatethi;
            }
          });
        },
      });
    });
}

function convertDateString(dateString) {
  // Giả sử dateString có định dạng DD-MM-YYYY
  var parts = dateString.split("/");
  var day = parts[0];
  var month = parts[1];
  var year = parts[2];

  // Tạo một chuỗi theo định dạng YYYY-MM-DD
  var formattedDate =
    year +
    "-" +
    (month.length === 1 ? "0" + month : month) +
    "-" +
    (day.length === 1 ? "0" + day : day);
  return formattedDate;
}

function convertDateStringRowTb(dateString) {
  var regex = /^\d{4}-\d{2}-\d{2}$/;
  if (regex.test(dateString)) {
    dateString = dateString.replace(/-/g, "/");
    var dateParts = dateString.split("/");
    var year = dateParts[0];
    var month = dateParts[1];
    var day = dateParts[2];

    // Chuyển đổi định dạng từ YYYY/MM/DD sang DD/MM/YYYY
    var formattedDate = `${day}/${month}/${year}`;
    return formattedDate;
  }
  return dateString;
}

// delete form
function handelformDelete() {
  const tablebody = document.getElementById("table-body-content");
  const btnDelete = document.querySelectorAll(".btn-delete");
  btnDelete &&
    btnDelete.forEach((btn, index) => {
      btn.addEventListener("click", () => {
        const row = tablebody.rows[index];
        const id = row.cells[1].textContent ?? "";
        tablebody.removeChild(row);

        const rows = tablebody.rows;
        if (rows.length > 0) {
          Array.from(rows).forEach((row, index) => {
            row.cells[0].textContent = index + 1;
          });
        }

        const formdata = new FormData();
        formdata.append("delete", true);
        formdata.append("ID", id);

        $.ajax({
          type: "post",
          data: formdata,
          url: "../mvc/Application.php",
          processData: false,
          contentType: false,
          success: function (response) {},
        });
      });
    });
}

// điểm rèn luyện
const selectNH = document.querySelector(".form-select-namhoc");
selectNH &&
  selectNH.addEventListener("change", function (event) {
    const selectedOption = event.target.value;
    const namhoc = selectedOption.split("-");

    const formdata = new FormData();
    formdata.append("selectNH", true);
    formdata.append("nam1", namhoc[0]);
    formdata.append("nam2", namhoc[1]);
    $.ajax({
      type: "post",
      data: formdata,
      url: "",
      processData: false,
      contentType: false,
      success: function (response) {
        const HKS = JSON.parse(decodeURIComponent(getCookie("hocKys")));
        $(".form-select-KH option").each(function () {
          $(this).remove();
        });
        $(".form-select-KH").append($("<option>").val("").text("Học Kỳ"));
        $(".form-select-KH").append($("<option>").val(HKS[0]).text("Học Kì 1"));
        $(".form-select-KH").append($("<option>").val(HKS[1]).text("Học Kì 2"));
        handleformselectKiHocCtsv();
      },
    });
  });

function handleformselectKiHocCtsv() {
  const selectKH = document.querySelector(".form-select-KH");
  selectKH &&
    selectKH.addEventListener("change", function (event) {
      const selectedOption = event.target.value;
      const formdata = new FormData();
      formdata.append("selectKH", true);
      formdata.append("Makihoc", selectedOption);
      $.ajax({
        type: "post",
        data: formdata,
        url: "../mvc/Application.php",
        processData: false,
        contentType: false,
        success: function (response) {
          $(".form-select-lophoc option").each(function () {
            $(this).remove();
          });
          const lhs = JSON.parse(decodeURIComponent(getCookie("lophocs")));
          $(".form-select-lophoc").append($("<option>").val("").text("Lớp"));
          lhs.forEach((element) => {
            $(".form-select-lophoc").append(
              $("<option>").val(element[0]).text(element[1])
            );
          });
        },
      });
    });
}

// khoa add gv
const btnAdd = document.querySelector(".btn-add");
btnAdd &&
  btnAdd.addEventListener("click", () => {
    $("#modalAdd").modal("show");
  });

$("#modalAdd").on("show.bs.modal", function (event) {
  const btnSubmitAdd = document.querySelector(".btnSubmitAdd");
  btnSubmitAdd.addEventListener("click", () => {
    const Inpvls = document.querySelectorAll(".ipvlt");
    const arrValues = [];

    Inpvls.forEach((e) => {
      arrValues.push(e.value);
    });
    const formdata = new FormData();
    formdata.append("btnSbAdd", true);
    formdata.append("values", JSON.stringify(arrValues));
    $.ajax({
      type: "post",
      data: formdata,
      url: "../mvc/Application.php",
      processData: false,
      contentType: false,
      success: function (response) {
        $("#modalAdd").modal("hide");
      },
    });
  });
});

$("#modalAdd").on("hidden.bs.modal", function (e) {
  const stateAddGv = getCookie("checkStateAdd");
  if (stateAddGv) {
    setTimeout(() => {
      handelToasts("Thêm giảng viên thành công");
      $(".toast").toast("show");
    }, 1000);
  }
});

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  document.cookie = `${name}=; expires=Hoa, 01 Jan 1970 00:00:00 UTC; path=/;`;
  if (parts.length === 2) return parts.pop().split(";").shift();
}

function handelToasts(message = "Đổi mật khẩu thành công") {
  const toast = document.getElementById("toast");
  const toastbody = toast.querySelector(".toast-body");
  toastbody.textContent = "";
  toastbody.textContent = message;
}

// giảng viên
const selectMonHoc = document.querySelector(".form-select-mon");
selectMonHoc &&
  selectMonHoc.addEventListener("change", function (event) {
    const selectedOption = event.target.value;
    const namhoc = selectedOption.split("-");

    const formdata = new FormData();
    formdata.append("selectMonDay", true);
    formdata.append("selectedOption", selectedOption);
    $.ajax({
      type: "post",
      data: formdata,
      url: "",
      processData: false,
      contentType: false,
      success: function (response) {
        const LHS = JSON.parse(decodeURIComponent(getCookie("lophocs")));
        $(".form-select-lophoc option").each(function () {
          $(this).remove();
        });
        $(".form-select-lophoc").append($("<option>").val("").text("Lớp"));
        LHS.forEach((e) => {
          $(".form-select-lophoc").append(
            $("<option>")
              .val(e[0])
              .text(e[1] + " - Thứ " + e[2] + "(" + e[3] + ")")
          );
        });
      },
    });
  });

function handleBtnUpdateTBQT() {
  const btnUpdateTBQT = document.querySelector(".btn-updateQT");
  const tablebodycontent = document.getElementById("table-body-content");
  if (tablebodycontent.textContent.trim() !== "") {
    btnUpdateTBQT &&
      btnUpdateTBQT.addEventListener("click", function () {
        const cells = tablebodycontent.querySelectorAll("td[dt-msv='msv']");
        const arrsmsv = [];
        Array.from(cells).forEach(function (e) {
          arrsmsv.push(e.textContent);
        });
        const mhp = $(".form-select-mon").find(":selected").val() ?? null;
        const mlhp = $(".form-select-lophoc").find(":selected").val() ?? null;
        const formdata = new FormData();
        formdata.append("btnUpdateTBQT", true);
        formdata.append("arrsmsv", JSON.stringify(arrsmsv));
        if (mhp && mlhp) {
          formdata.append("mahocphan", mhp);
          formdata.append("malophocphan", mlhp);
        }
        $.ajax({
          type: "post",
          data: formdata,
          url: "",
          processData: false,
          contentType: false,
          success: function (response) {
            // for (var pair of formdata.entries()) {
            //   console.log(pair[0] + ", " + pair[1]);
            // }

            const statedttk = getCookie("statedatatk");
            if (statedttk) {
              var startIndex = response.indexOf('<div id="contenthide"');
              // Nếu tìm thấy thẻ div
              if (startIndex !== -1) {
                // Tìm vị trí kết thúc của thẻ div
                var endIndex = response.indexOf("</div>", startIndex);
                // Nếu tìm thấy kết thúc của thẻ div
                if (endIndex !== -1) {
                  // Cắt chuỗi để lấy phần tử của thẻ div
                  const divContent = response.substring(
                    startIndex,
                    endIndex + 6
                  ); // +6 để bao gồm cả ký tự '</div>'
                  // Hiển thị nội dung của thẻ div
                  const parser = new DOMParser();
                  const html = parser.parseFromString(divContent, "text/html");
                  const divhide = html.getElementById("contenthide");
                  const datatk = JSON.parse(divhide.textContent);
                  console.log(datatk);

                  const rows = tablebodycontent.querySelectorAll("tr");
                  rows.forEach((row) => {
                    const cellmsv = row.querySelector("td[dt-msv]").textContent;
                    const celldtkqt = row.querySelector("td[dt-tkqt]");
                    celldtkqt.textContent = datatk[`${cellmsv}`];
                  });
                }
              }
            }
          },
        });
      });
  }
}
