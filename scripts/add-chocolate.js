let idBahan = 1;
let totalBahan = 1;
let listIdBahan = [1];

const supplies = document.getElementById("supplies");

function addBahanField() {
    if (totalBahan == 10) {
        window.alert("Max 10 bahan");
        return;
    }
    let bahanList = document.getElementById("bahan-list");
    let newBahan = document.createElement("div");
    idBahan++;
    totalBahan++;
    removeAddButtonFromLastChild(() => {
        newBahan.className = "bahan-field";
        newBahan.id = `bahan${idBahan}`;
        newBahan.innerHTML = 
            `<div><input id="namabahan${idBahan}" type="text" name="bahan[]" autocomplete="off" size="50"> </div>
            <div id="add${idBahan}" class="btn-add" onClick="addBahanField()"> <b> Add </b> </div> 
            <div class="btn-cancel" onClick="removeBahanField('bahan${idBahan}')"> <b> Remove </b> </div>
            <div> Jumlah Satuan: </div>
            <div> <input class="plus-minus-button" type="button" onclick="minusButton('quantity${idBahan}')" value="-"> </div>
            <div> <input type="number" id="quantity${idBahan}" name="quantity[]" value="0" style="text-align: center;" readonly required> </div>
            <div> <input class="plus-minus-button" type="button" onclick="plusButton('quantity${idBahan}')" value="+"> </div>`;
        bahanList.appendChild(newBahan);
        listIdBahan.push(idBahan);
    });
}

function removeBahanField(id) {
    if (totalBahan == 1) {
        return;
    }
    totalBahan--;
    let numID = parseInt(id.substring(5));
    let index = listIdBahan.indexOf(numID);
    if (index !== -1) {
        listIdBahan.splice(index, 1);
    }
    showAddButtonFromLastChild();
    updateHarga(numID, (-1) * parseInt(document.getElementById(`quantity${numID}`).value));

    let removeBahan = document.getElementById(id);
    removeBahan.remove();
}

function removeAddButtonFromLastChild(callback) {
    const lastID = listIdBahan[listIdBahan.length - 1];
    let addButtonWithID = document.getElementById(`add${lastID}`);
    addButtonWithID.style.visibility = 'hidden';
    callback();
}

function showAddButtonFromLastChild() {
    const lastID = listIdBahan[listIdBahan.length - 1];
    let addButtonWithID = document.getElementById(`add${lastID}`);
    addButtonWithID.style.visibility = 'visible';
}

function plusButton(id) {
    let temp = parseInt(document.getElementById(id).value) + 1;
    document.getElementById(id).defaultValue = String(temp);
    console.log(id);
    let numID = parseInt(id.substring(8));
    updateHarga(numID, 1);
}

function minusButton(id) {
    if (parseInt(document.getElementById(id).value) > 1) {
        let temp = parseInt(document.getElementById(id).value) - 1;
        document.getElementById(id).defaultValue = String(temp);
        let numID = parseInt(id.substring(8));
        updateHarga(numID, -1);
    }
}

function getHargaFromNama(namaBahan) {
    for (let row of supplies.rows) {
        const temp = row.cells[0].innerText;
        console.log(`temp: ${temp}`);
        if (temp === namaBahan) {
            return parseInt(row.cells[1].innerText);
        }
    }
    return null;
}

function updateHarga(numID, change) {
    let bahanID = document.getElementById(`namabahan${numID}`);
    if (bahanID.value === "" || bahanID.value === null) {
        return;
    }
    const namaBahan = bahanID.value;
    console.log(`nama bahan: ${namaBahan}`);
    const hargaBahan = getHargaFromNama(namaBahan);
    console.log(`harga bahan: ${hargaBahan}`);
    if (hargaBahan == null) {
        return;
    }
    let hargaCoklat = parseInt(document.getElementById("perkiraanharga").value.substring(3));
    hargaCoklat = hargaCoklat + change * hargaBahan;
    document.getElementById("perkiraanharga").defaultValue = String(`Rp ${hargaCoklat}`);
}