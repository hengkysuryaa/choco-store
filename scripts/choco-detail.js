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
    var price = parseInt(document.getElementById("price").textContent)
    document.getElementById("totalprice").innerHTML = "Rp " + String(temp * price)
}

function minusButtonBuy() {
    if (parseInt(document.getElementById("quantity").value) > 1) {
        var temp = parseInt(document.getElementById("quantity").value) - 1
        document.getElementById("quantity").defaultValue = String(temp)
        var price = parseInt(document.getElementById("price").textContent)
        document.getElementById("totalprice").innerHTML = "Rp " + String(temp * price)
    }
}