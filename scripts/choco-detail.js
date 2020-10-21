function plusButton() {
    var temp = parseInt(document.getElementById("quantity").value) + 1
    document.getElementById("quantity").defaultValue = String(temp)
}

function minusButton() {
    if (parseInt(document.getElementById("quantity").value) > 1) {
        var temp = parseInt(document.getElementById("quantity").value) - 1
        document.getElementById("quantity").defaultValue = String(temp)
    }
}

function plusButtonBuy() {
    var temp = parseInt(document.getElementById("quantity").value) + 1
    document.getElementById("quantity").defaultValue = String(temp)
    document.getElementById("totalprice").innerHTML = "Rp " + String(temp * 10000)
}

function minusButtonBuy() {
    if (parseInt(document.getElementById("quantity").value) > 1) {
        var temp = parseInt(document.getElementById("quantity").value) - 1
        document.getElementById("quantity").defaultValue = String(temp)
        document.getElementById("totalprice").innerHTML = "Rp " + String(temp * 10000)
    }
}