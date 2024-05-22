function tabHere() {
  const url = location.pathname;
  const listTab = document.querySelectorAll(".sidebar-item a");

  const checked = Array.from(listTab).some((e) => {
    const t = e.getAttribute("href");
    return new RegExp(t).test(url);
  });
  if (checked) {
    for (var i = 0; i < listTab.length; i++) {
      const href = listTab[i].getAttribute("href");
      const temp = new RegExp(href);
      if (temp.test(url)) {
        listTab[i].classList.add("here");

        if (temp.test("quan-ly-lop") || temp.test("sinh-vien-trong-lop")) {
          document.querySelector(".collapsed").click();
        }

        break;
      }
    }
  } else {
    listTab[0] && listTab[0].classList.add("here");
  }
}

tabHere();

function tableToExcel() {
  const table2excel = new Table2Excel();
  table2excel.export(
    document.querySelectorAll("table.table"),
    "chuong_tringh_khung"
  );
}

// export file excel
const btnExport = document.querySelector(".btn-export");
btnExport &&
  btnExport.addEventListener("click", function () {
    const filename = this.getAttribute("data-page");
    html_table_to_excel(filename, "xlsx");
  });

function html_table_to_excel(filename, type) {
  const data = document.querySelector("table.table");
  const clonedTable = data.cloneNode(true);
  var rowtb = clonedTable.rows;

  const indexclomuns = Array.from(rowtb[0].cells).findIndex(function (e) {
    if (e.hasAttribute("data-colums")) {
      return e.getAttribute("data-colums") == "controls";
    }
  });
  for (var j = 0; j < rowtb.length; j++) {
    rowtb[j].deleteCell(indexclomuns);
  }

  clonedTable.querySelectorAll("select").forEach((select) => {
    const selectedValue = select.options[select.selectedIndex].text;
    const td = select.parentElement;
    td.innerHTML = selectedValue;
  });

  const file = XLSX.utils.table_to_book(clonedTable, { sheet: "sheet1" });

  // fit columns
  var worksheet = file.Sheets["sheet1"];

  var colWidths = Array.from(
    { length: clonedTable.rows[0].cells.length },
    () => ({ wch: 10 })
  );
  worksheet["!cols"] = colWidths;

  XLSX.write(file, { bookType: type, bookSST: true, type: "base64" });
  XLSX.writeFile(file, `${filename}.` + type);
}
