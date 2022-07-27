function Cart() {
    let amountE, totalE, priceE, orderE, productE, sizeE;
    let amount, total, price;

    amountE = document.querySelectorAll('.cart__amountE');
    totalE = document.querySelectorAll('.cart__totalE');
    priceE = document.querySelectorAll('.cart__priceE');
    orderE = document.querySelector('.cart__orderE');

    productE = document.querySelectorAll('.cart__data--product');
    sizeE = document.querySelectorAll('.cart__data--size');


    amountE.forEach((item, index) => {
        item.addEventListener('change', (e) => {
            if (e.target.value <= 0) {
                alert("Vui lòng chọn số lượng lớn hơn 0");
            }
            else {
                totalE[index].innerText = (e.target.value * priceE[index].value).toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
                handleTotal();
                orderE.innerText = total.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
            }
        });
    });

    function handleTotal() {
        total = 0;
        amountE.forEach((item, index) => {
            total += (item.value * priceE[index].value);
        })
    }
}

console.log(api);
Cart();