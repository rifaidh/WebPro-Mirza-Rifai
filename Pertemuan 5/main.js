// Fungsi Autocomplete
function buatAutocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        tutupSemuaList();
        if (!val) { return false;}
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++) {
            if (arr[i].toUpperCase().indexOf(val.toUpperCase()) > -1) {
                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    tutupSemuaList();
                });
                a.appendChild(b);
            }
        }
    });

    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) { currentFocus++; tambahAktif(x); }
        else if (e.keyCode == 38) { currentFocus--; tambahAktif(x); }
        else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });

    function tambahAktif(x) {
        if (!x) return false;
        hapusAktif(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }

    function hapusAktif(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function tutupSemuaList(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function (e) {
        tutupSemuaList(e.target);
    });
}

// Inisialisasi Autocomplete
document.addEventListener("DOMContentLoaded", function() {
    buatAutocomplete(document.getElementById("nama"), namaMahasiswa);

    document.getElementById("formMahasiswa").addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        document.getElementById("outputMahasiswa").innerHTML = "<pre>" + JSON.stringify(data, null, 2) + "<pre>";
    });
});

// Dropdown Kode Pos
function dropdownKodepos() {
    const provSelect = document.getElementById('provinsi');
    const kabSelect = document.getElementById('kabupaten');
    const kecSelect = document.getElementById('kecamatan');

    Object.keys(dataKodepos).forEach(prov => {
        const option = document.createElement('option');
        option.value = prov;
        option.textContent = prov;
        provSelect.appendChild(option);
    });

    provSelect.addEventListener('change', function() {
        kabSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kecSelect.disabled = true;
        kabSelect.disabled = this.value ? false : true;
        if (this.value) {
            const kabs = dataKodepos[this.value];
            Object.keys(kabs).forEach(kab => {
                const option = document.createElement('option');
                option.value = kab;
                option.textContent = kab;
                kabSelect.appendChild(option);
            });
        }
    });

    kabSelect.addEventListener('change', function() {
        kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kecSelect.disabled = this.value ? false : true;
        if (this.value && provSelect.value) {
            const kecs = dataKodepos[provSelect.value][this.value];
            Object.keys(kecs).forEach(kec => {
                const option = document.createElement('option');
                option.value = kec;
                option.textContent = kec;
                kecSelect.appendChild(option);
            });
        }
    });

    document.getElementById('kodepos').addEventListener('submit', function(e) {
        e.preventDefault();
        const prov = provSelect.value;
        const kab = kabSelect.value;
        const kec = kecSelect.value;
        if (prov && kab && kec) {
            const data = dataKodepos[prov][kab][kec];
            document.getElementById('outputPos').innerHTML = `
                <p><strong>Kode Pos:</strong> ${data.code}</p>
                <p><strong>Informasi Daerah:</strong> ${data.info}</p>
            `;
        } else {
            document.getElementById('outputPos').innerHTML = '<p>Silakan pilih lengkap semua field.</p>';
        }
    });
}

// Dropdown Elektronik
function dropdownElektronik() {
    const katSelect = document.getElementById('kategori');
    const merkSelect = document.getElementById('merk');

    Object.keys(dataElektronik).forEach(kat => {
        const option = document.createElement('option');
        option.value = kat;
        option.textContent = kat;
        katSelect.appendChild(option);
    });

    katSelect.addEventListener('change', function() {
        merkSelect.innerHTML = '<option value="">Pilih Merk</option>';
        merkSelect.disabled = this.value ? false : true;
        if (this.value) {
            dataElektronik[this.value].forEach(merk => {
                const option = document.createElement('option');
                option.value = merk;
                option.textContent = merk;
                merkSelect.appendChild(option);
            });
        }
    });

    document.getElementById('merkElektronik').addEventListener('submit', function(e) {
        e.preventDefault();
        const kat = katSelect.value;
        const merk = merkSelect.value;
        if (kat && merk) {
            document.getElementById('outputElektronik').innerHTML = `<p>Pilihan: ${kat} - ${merk}</p>`;
        } else {
            document.getElementById('outputElektronik').innerHTML = '<p>Silakan pilih lengkap.</p>';
        }
    });
}

// Inisialisasi seluruh dropdown
document.addEventListener("DOMContentLoaded", function() {
    dropdownKodepos();
    dropdownElektronik();
});
