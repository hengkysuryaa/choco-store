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
        `<input type="text" name="count" autocomplete="off" size="50"> 
        <div class="btn-add" onClick="addBahanField()"> <b> Add </b> </div> 
        <div class="btn-cancel" onClick="removeBahanField('bahan${idBahan}')"> <b> Remove </b> </div>`
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