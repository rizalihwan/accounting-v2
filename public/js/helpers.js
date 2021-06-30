const formatRupiah = (angka, prefix) => {
    let number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}


const formatter =  (numb) => {
    const rupiah = new Intl.NumberFormat('en-ID', {
        style: 'currency',
        currency: 'IDR'
      }).format(numb)
      .replace(/[IDR]/gi, '')
      .replace(/(\.+\d{2})/, '')
      .trimLeft()
    return rupiah;
}