// Search Data realtime
function searchData() {
    let input = document.getElementById("myInput"),
        filter = input.value.toUpperCase(),
        table = document.getElementById("myTable"),
        tr = table.getElementsByTagName("tr"),
        td, tdArr, i, j;

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        tdArr = tr[i].getElementsByTagName("td");
        for (j = 0; j < tdArr.length; j++) {
            td = tdArr[j];
            if (td && td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                break;
            }
        }
    }
}

// Sorting
const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const compare = (idx, asc) => (a, b) => ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
)(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    const tbody = table.querySelector('tbody');
    Array.from(tbody.querySelectorAll('tr'))
        .sort(compare(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => tbody.appendChild(tr));
})));
