let idBahan = 1;
let totalBahan = 1;

function addBahanField() {
    let bahanList = document.getElementById("bahan-list");
    let newBahan = document.createElement("div");
    idBahan++;
    totalBahan++;
    newBahan.className = "bahan-field";
    newBahan.id = `bahan${idBahan}`;
    newBahan.innerHTML = 
        `<div><input type="text" name="count" autocomplete="off" size="50"> </div>
        <div class="btn-add" onClick="addBahanField()"> <b> Add </b> </div> 
        <div class="btn-cancel" onClick="removeBahanField('bahan${idBahan}')"> <b> Remove </b> </div>
        <div> Jumlah Satuan: </div>
        <div> <input class="plus-minus-button" type="button" onclick="minusButton('quantity${idBahan}')" value="-"> </div>
        <div> <input type="number" id="quantity${idBahan}" name="quantity${idBahan}" value="1" style="text-align: center;" readonly required> </div>
        <div> <input class="plus-minus-button" type="button" onclick="plusButton('quantity${idBahan}')" value="+"> </div>`;
    bahanList.appendChild(newBahan);
}

function removeBahanField(id) {
    if (totalBahan == 1) {
        return;
    }
    totalBahan--;
    let removeBahan = document.getElementById(id);
    removeBahan.remove();
}

function plusButton(id) {
    let temp = parseInt(document.getElementById(id).value) + 1;
    document.getElementById(id).defaultValue = String(temp)
}

function minusButton(id) {
    if (parseInt(document.getElementById(id).value) > 1) {
        let temp = parseInt(document.getElementById(id).value) - 1;
        document.getElementById(id).defaultValue = String(temp)
    }
}