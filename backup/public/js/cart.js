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
                let url = api + 'cart';
                let form = new FormData();
                form.append("product", productE[index].value);
                form.append("size", sizeE[index].value);
                form.append("amount", e.target.value);
                fetch(url, { method: 'post', body: form ,headers: {
                    'Authorization': 'Bearer '+document.cookie.
                 },})
                    .then(response => response.json())
                    .then(response => alert(response.message))
                    .catch(error => alert(error));

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